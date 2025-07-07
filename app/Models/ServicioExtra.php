<?php

// app/Models/ServicioExtra.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioExtra extends Model
{
    protected $table = 'servicio_extras';

    protected $fillable = ['nombre', 'precio'];

    public function detalleReservas()
    {
        return $this->hasMany(DetalleReserva::class, 'servicio_extra_id');
    }
}
