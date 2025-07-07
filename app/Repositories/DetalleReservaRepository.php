<?php

namespace App\Repositories;

use App\Models\DetalleReserva;

class DetalleReservaRepository
{

    public function crear(array $data)
    {
        return DetalleReserva::create($data);
    }

    public function obtenerPorReserva($reservaId)
    {
        return DetalleReserva::where('reserva_id', $reservaId)->get();
    }

    public function create(array $data)
    {
        return DetalleReserva::create($data);
    }

    public function update($id, array $data)
    {
        $detalle = DetalleReserva::findOrFail($id);
        $detalle->update($data);
        return $detalle;
    }

    public function delete($id)
    {
        return DetalleReserva::findOrFail($id)->delete();
    }
}
