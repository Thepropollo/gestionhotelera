<?php

namespace App\Repositories;

use App\Models\Habitacion;
use App\Models\Mesa;
use App\Models\Salon;
use App\Models\Reserva;

class DisponibilidadRepository
{
    public function recursosDisponibles($tipo, $inicio, $fin)
    {
        $idsOcupados = Reserva::where('tipo_reserva', $tipo)
            ->where('estado', '!=', 'cancelada')
            ->where(function ($query) use ($inicio, $fin) {
                $query->where(function ($q) use ($inicio, $fin) {
                    $q->where('fecha_inicio', '<', $fin)
                      ->where('fecha_fin', '>', $inicio);
                });
            })
            ->pluck('id_objeto')
            ->toArray();

        switch ($tipo) {
            case 'habitacion':
                return Habitacion::whereNotIn('id', $idsOcupados)->get();
            case 'mesa':
                return Mesa::whereNotIn('id', $idsOcupados)->get();
            case 'salon':
                return Salon::whereNotIn('id', $idsOcupados)->get();
            default:
                return [];
        }
    }
}
