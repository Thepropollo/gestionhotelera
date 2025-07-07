<?php

// app/Models/Participacion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participacion extends Model
{
    protected $table = 'participacion';

    protected $fillable = [
        'reserva_id',
        'usuario_id',
        'rol_en_reserva',
        'observaciones'
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}

