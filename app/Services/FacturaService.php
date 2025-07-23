<?php

namespace App\Services;

use App\Repositories\FacturaRepository;
use App\Repositories\DetalleFacturaRepository;
use App\Repositories\ReservaRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Reserva;
use App\Models\Factura;
use App\Models\ServicioExtra;


class FacturaService
{
    protected $facturaRepo;
    protected $reservaRepo;




    public function __construct(FacturaRepository $facturaRepo, ReservaRepository $reservaRepo, DetalleFacturaRepository $repoDetalle)
    {
        $this->facturaRepo = $facturaRepo;
        $this->reservaRepo = $reservaRepo;
        $this->repoDetalle = $repoDetalle;
    }

    public function facturar(array $data)
    {
        DB::beginTransaction();

        try {
            $subtotal = 0;
            $detalles = [];

            foreach ($data['reservas'] as $reservaId) {
                $reserva = Reserva::with(['habitacion', 'mesa', 'salon'])->findOrFail($reservaId);
                $precio = $this->calcularPrecioReserva($reserva);

                $detalles[] = [
                    'descripcion' => "Reserva de " . $reserva->tipo_reserva . " ID {$reserva->id_objeto}",
                    'cantidad' => 1,
                    'precio_unitario' => (float) number_format($precio, 2, '.', ''),
                    'total_linea' => (float) number_format($precio, 2, '.', '')
                ];

                $subtotal += $precio;
            }

            foreach ($data['servicios_extra'] ?? [] as $extra) {
                $servicio = ServicioExtra::findOrFail($extra['servicio_extra_id']);
                $linea = $servicio->precio * $extra['cantidad'];

                $detalles[] = [
                    'descripcion' => "Servicio extra: " . $servicio->nombre,
                    'cantidad' => (int) $extra['cantidad'],
                    'precio_unitario' => (float) number_format($servicio->precio, 2, '.', ''),
                    'total_linea' => (float) number_format($linea, 2, '.', '')
                ];

                $subtotal += $linea;
            }

            $impuesto = $subtotal * 0.12;
            $descuento = $data['descuento'] ?? 0;
            $total = $subtotal + $impuesto - $descuento;

            $factura = Factura::create([
                'cliente_id' => $data['cliente_id'],
                'usuario_id' => $data['usuario_id'],
                'fecha' => now(),
                'subtotal' => $subtotal,
                'impuesto' => $impuesto,
                'descuento' => $descuento,
                'total' => $total,
                'estado_pago' => 'pendiente'
            ]);

            foreach ($detalles as $detalle) {
                $factura->detalles()->create($detalle);
            }

            DB::commit();

            return $factura->load('detalles');

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function marcarPagada($id)
    {
        $factura = $this->facturaRepo->find($id);

        if ($factura->estado_pago === 'pagada') {
            throw ValidationException::withMessages([
                'estado_pago' => 'La factura ya ha sido marcada como pagada.'
            ]);
        }

        return $this->facturaRepo->update($id, ['estado_pago' => 'pagada']);
    }

    public function obtenerTodas()
    {
        return $this->facturaRepo->all();
    }

    public function obtenerPorCliente($clienteId)
    {
        return $this->facturaRepo->obtenerPorCliente($clienteId);
    }

    public function crearFacturaConsolidada(array $data)
    {
        return DB::transaction(function () use ($data) {
            $clienteId = $data['cliente_id'];
            $usuarioId = $data['usuario_id'];
            $reservaIds = $data['reserva_ids'];
            $descuento = $data['descuento'] ?? 0;

            $subtotal = 0;

            // Traer todas las reservas y sus servicios extras para sumar precios
            $reservas = $this->reservaRepo->obtenerPorIds($reservaIds);

            foreach ($reservas as $reserva) {
                // Suma precio base
                $subtotal += $this->calcularPrecioReserva($reserva);

                // Suma servicios extra asociados
                foreach ($reserva->detalleReserva as $detalle) {
                    $subtotal += $detalle->precio_total;
                }
            }

            $impuesto = $subtotal * 0.12; // ejemplo 12%
            $total = $subtotal + $impuesto - $descuento;

            // Crear factura
            $factura = $this->facturaRepo->create([
                'cliente_id' => $clienteId,
                'usuario_id' => $usuarioId,
                'fecha' => now(),
                'subtotal' => $subtotal,
                'impuesto' => $impuesto,
                'descuento' => $descuento,
                'total' => $total,
                'estado_pago' => 'pendiente',
            ]);

            // Crear detalles factura por cada reserva y servicio extra
            foreach ($reservas as $reserva) {
                $this->repoDetalle->create([
                    'factura_id' => $factura->id,
                    'descripcion' => 'Reserva ' . $reserva->id . ' - ' . $reserva->tipo_reserva,
                    'cantidad' => 1,
                    'precio_unitario' => $this->calcularPrecioReserva($reserva),
                    'total_linea' => $this->calcularPrecioReserva($reserva),
                ]);

                foreach ($reserva->detalleReserva as $detalle) {
                    $this->repoDetalle->create([
                        'factura_id' => $factura->id,
                        'descripcion' => 'Servicio extra: ' . $detalle->servicioExtra->nombre,
                        'cantidad' => $detalle->cantidad,
                        'precio_unitario' => $detalle->precio_total / $detalle->cantidad,
                        'total_linea' => $detalle->precio_total,
                    ]);
                }
            }

            return $factura;
        });
    }

    protected function calcularPrecioReserva($reserva)
    {
        $objeto = $reserva->objetoReservado();

        if (!$objeto) {
            throw new \Exception("No se encontró el objeto reservado (tipo: {$reserva->tipo_reserva}, ID: {$reserva->id_objeto})");
        }

        switch ($reserva->tipo_reserva) {
            case 'habitacion':
                $dias = max($reserva->fecha_fin->diffInDays($reserva->fecha_inicio), 1);
                return $objeto->precio_noche * $dias;

            case 'salon':
                return $objeto->precio_alquiler;

            case 'mesa':
                return $objeto->precio;

            default:
                throw new \Exception("Tipo de reserva no válido: {$reserva->tipo_reserva}");
        }
    }
}
