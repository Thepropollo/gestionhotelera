<?php

namespace App\Repositories;

use App\Models\Usuario;

class AuthRepository
{
    public function buscarPorCorreo(string $correo)
    {
        return Usuario::where('correo', $correo)
            ->with('rol')
            ->first();
    }
}
