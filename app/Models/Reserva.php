<?php

// app/Models/Reserva.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime'
    ];

    protected $fillable = [
        'cliente_id',
        'tipo_reserva',
        'id_objeto',
        'fecha_inicio',     // <-- Agrega esto
        'fecha_fin',        //
        'estado',
        'observaciones'

    ];
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

    // Método para obtener el objeto reservado (habitacion, mesa o salon)
    public function objetoReservado()
    {
        switch ($this->tipo_reserva) {
            case 'habitacion':
                return $this->belongsTo(Habitacion::class, 'id_objeto');
            case 'mesa':
                return $this->belongsTo(Mesa::class, 'id_objeto');
            case 'salon':
                return $this->belongsTo(Salon::class, 'id_objeto');
            default:
                return null;
        }
    }
}
