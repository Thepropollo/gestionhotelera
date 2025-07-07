<?php

// app/Models/Habitacion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitacions';

    protected $fillable = ['numero', 'tipo', 'estado', 'precio_noche'];
}
