<?php

namespace App\Repositories;

use App\Models\Reserva;

class ReservaRepository
{
    public function all()
    {
        return Reserva::all();
    }

    public function find($id)
    {
        return Reserva::findOrFail($id);
    }

    public function create(array $data)
    {
        return Reserva::create($data);
    }

    public function update($id, array $data)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->update($data);
        return $reserva;
    }

    public function delete($id)
    {
        return Reserva::findOrFail($id)->delete();
    }

    public function existeReservaEnRango(string $tipo, int $id_objeto, $inicio, $fin): bool
    {
    return Reserva::where('tipo_reserva', $tipo)
        ->where('id_objeto', $id_objeto)
        ->where('estado', '!=', 'cancelada')
        ->where(function ($query) use ($inicio, $fin) {
            $query->where(function ($q) use ($inicio, $fin) {
                $q->where('fecha_inicio', '<', $fin)
                  ->where('fecha_fin', '>', $inicio);
            });
        })->exists();
    }

    public function verificarDisponibilidad(string $tipo, int $id_objeto, $inicio, $fin): bool
    {
    return Reserva::where('tipo_reserva', $tipo)
        ->where('id_objeto', $id_objeto)
        ->where('estado', '!=', 'cancelada')
        ->where(function ($query) use ($inicio, $fin) {
            $query->where(function ($q) use ($inicio, $fin) {
                $q->where('fecha_inicio', '<', $fin)
                  ->where('fecha_fin', '>', $inicio);
            });
        })->exists();
    }


    public function reservasPorCliente($clienteId)
    {
    return Reserva::where('cliente_id', $clienteId)
        ->orderBy('fecha_inicio', 'desc')
        ->get();
    }

    public function obtenerPorIds(array $ids)
{
    return Reserva::with('detalleReserva.servicioExtra', 'habitacion', 'mesa', 'salon')
        ->whereIn('id', $ids)
        ->get();
}




}
