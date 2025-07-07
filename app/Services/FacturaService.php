<?php

namespace App\Services;

use App\Repositories\FacturaRepository;
use App\Repositories\DetalleFacturaRepository;
use App\Repositories\ReservaRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function procesarFacturaCompleta(array $data)
    {
        return DB::transaction(function () use ($data) {
            $subtotal = 0;
            $detalleFactura = [];

            // Procesar reservas
            foreach ($data['reservas'] as $reserva) {
                $this->reservaRepo->verificarDisponibilidad(
                    $reserva['tipo_reserva'],
                    $reserva['id_objeto'],
                    $reserva['fecha_inicio'],
                    $reserva['fecha_fin']
                );

                $reserva['cliente_id'] = $data['cliente_id'];
                $reserva['estado'] = 'confirmada';

                $nuevaReserva = $this->reservaRepo->create($reserva);

                $precio = $this->facturaRepo->obtenerPrecioReserva($reserva);
                $dias = Carbon::parse($reserva['fecha_inicio'])->diffInDays(Carbon::parse($reserva['fecha_fin']));
                $monto = $precio * max($dias, 1);

                $subtotal += $monto;

                $detalleFactura[] = [
                    'descripcion'     => ucfirst($reserva['tipo_reserva']) . " ID {$reserva['id_objeto']}",
                    'cantidad'        => max($dias, 1),
                    'precio_unitario' => $precio,
                    'total_linea'     => $monto
                ];
            }

            // Servicios extra
            foreach ($data['servicio_extras'] ?? [] as $servicio) {
                $precio = $this->facturaRepo->obtenerPrecioServicioExtra($servicio['servicio_extra_id']);
                $monto = $precio * $servicio['cantidad'];
                $subtotal += $monto;

                $detalleFactura[] = [
                    'descripcion'     => "Servicio extra ID {$servicio['servicio_extra_id']}",
                    'cantidad'        => $servicio['cantidad'],
                    'precio_unitario' => $precio,
                    'total_linea'     => $monto
                ];
            }

            $impuesto = $subtotal * 0.12;
            $descuento = 0;
            $total = $subtotal + $impuesto - $descuento;

            return $this->facturaRepo->crearFacturaCompleta([
                'cliente_id' => $data['cliente_id'],
                'usuario_id' => auth()->id(),
                'fecha'      => now(),
                'subtotal'   => $subtotal,
                'impuesto'   => $impuesto,
                'descuento'  => $descuento,
                'total'      => $total,
                'estado_pago' => 'pendiente',
                'detalle'    => $detalleFactura
            ]);
        });
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
    return DB::transaction(function() use ($data) {
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
    // Puedes poner lógica para calcular el precio dependiendo del tipo
    switch ($reserva->tipo_reserva) {
        case 'habitacion':
            $habitacion = $reserva->habitacion; // relación debe existir
            $dias = $reserva->fecha_fin->diffInDays($reserva->fecha_inicio);
            return $habitacion->precio_noche * $dias;
        case 'mesa':
            $mesa = $reserva->mesa; // relación debe existir
            // Precio fijo o por hora si tienes
            return 50; // ejemplo
        case 'salon':
            $salon = $reserva->salon; // relación debe existir
            $dias = $reserva->fecha_fin->diffInDays($reserva->fecha_inicio);
            return $salon->precio_alquiler * $dias;
        default:
            return 0;
    }
}


}
