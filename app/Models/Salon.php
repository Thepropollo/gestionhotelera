<?php

// app/Models/Salon.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    protected $table = 'salons';

    protected $fillable = ['nombre', 'capacidad', 'estado', 'precio_alquiler'];
}
