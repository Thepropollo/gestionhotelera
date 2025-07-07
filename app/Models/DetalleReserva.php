<?php

// app/Models/DetalleReserva.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    protected $table = 'detalle_reservas';

    protected $fillable = ['reserva_id', 'servicio_extra_id', 'cantidad', 'precio_total'];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    public function servicioExtra()
    {
        return $this->belongsTo(ServicioExtra::class, 'servicio_extra_id');
    }
}
