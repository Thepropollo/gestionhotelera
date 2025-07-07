<?php

namespace App\Repositories;

use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\ServicioExtra;
use App\Models\Habitacion;
use App\Models\Salon;
use App\Models\Mesa;

class FacturaRepository
{

    public function all()
    {
        return Factura::all();
    }

    public function find($id)
    {
        return Factura::findOrFail($id);
    }

    public function crearFacturaCompleta(array $data)
    {
        $factura = Factura::create([
            'cliente_id'  => $data['cliente_id'],
            'reserva_id'  => null, // reservas múltiples
            'usuario_id'  => $data['usuario_id'],
            'fecha'       => $data['fecha'],
            'subtotal'    => $data['subtotal'],
            'impuesto'    => $data['impuesto'],
            'descuento'   => $data['descuento'],
            'total'       => $data['total'],
            'estado_pago' => $data['estado_pago'],
        ]);

        foreach ($data['detalle'] as $linea) {
            DetalleFactura::create([
                'factura_id'      => $factura->id,
                'descripcion'     => $linea['descripcion'],
                'cantidad'        => $linea['cantidad'],
                'precio_unitario' => $linea['precio_unitario'],
                'total_linea'     => $linea['total_linea'],
            ]);
        }

        return $factura->load('detalles');
    }

    public function obtenerPrecioReserva(array $reserva)
    {
        return match ($reserva['tipo_reserva']) {
            'habitacion' => Habitacion::find($reserva['id_objeto'])->precio_noche,
            'salon'      => Salon::find($reserva['id_objeto'])->precio_alquiler,
            'mesa'       => 50, // precio fijo o agregado al modelo Mesa
        };
    }

    public function obtenerPrecioServicioExtra($id)
    {
        return ServicioExtra::find($id)->precio;
    }

    public function update($id, array $data)
    {
    $factura = Factura::findOrFail($id);
    $factura->update($data);
    return $factura;
    }

    public function obtenerPorCliente($clienteId)
    {
    return Factura::with('detalles', 'usuario', 'reserva')
        ->where('cliente_id', $clienteId)
        ->get();
    }

    public function create(array $data)
    {
        return Factura::create($data);
    }

}
