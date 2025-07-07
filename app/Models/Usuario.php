<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre', 'correo', 'password', 'rol_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}

// {
//   "correo": "maria@hotel.com",
//   "password": "12345678"
// // }
//     {
//         "correo": "juan.perez@example.com",
//     "password": "unaContrasenaSegura123"
//     }