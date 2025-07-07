<?php

// app/Models/Cliente.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = ['nombre', 'cedula', 'telefono'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'cliente_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'cliente_id');
    }
}

