<?php

// app/Models/Reserva.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';


    protected $fillable = [
<<<<<<< HEAD
        'cliente_id',
        'tipo_reserva',
        'id_objeto',
        'fecha_inicio',     // <-- Agrega esto
        'fecha_fin',        //
        'estado',
        'observaciones'

    ];
=======
    'cliente_id',
    'tipo_reserva',
    'id_objeto',
    'fecha_inicio',
    'fecha_fin',
    'estado',
];


>>>>>>> 374d370aa32f98f174473b190e4eac1558da4909
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function detalleReservas()
    {
        return $this->hasMany(DetalleReserva::class, 'reserva_id');
    }

    public function detalleReserva()
    {
        return $this->hasMany(DetalleReserva::class, 'reserva_id');
    }

    public function participaciones()
    {
        return $this->hasMany(Participacion::class, 'reserva_id');
    }


    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'id_objeto');
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'id_objeto');
    }

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'id_objeto');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'reserva_id');
    }

    public function objetoReservado()
    {
        switch ($this->tipo_reserva) {
            case 'habitacion':
                $habitacion = Habitacion::find($this->id_objeto);
                if (!$habitacion) {
                    throw new \Exception("Habitación no encontrada con ID {$this->id_objeto}");
                }
                return $habitacion;

            case 'mesa':
                $mesa = Mesa::find($this->id_objeto);
                if (!$mesa) {
                    throw new \Exception("Mesa no encontrada con ID {$this->id_objeto}");
                }
                return $mesa;

            case 'salon':
                $salon = Salon::find($this->id_objeto);
                if (!$salon) {
                    throw new \Exception("Salón no encontrado con ID {$this->id_objeto}");
                }
                return $salon;

            default:
                throw new \Exception("Tipo de reserva inválido: {$this->tipo_reserva}");
        }
    }


}
