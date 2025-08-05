<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function login(string $correo, string $password)
    {
        $usuario = $this->authRepo->buscarPorCorreo($correo);

        $usuario->load('rol');

        if (!$usuario || !Hash::check($password, $usuario->password)) {
            return null;
        }

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'usuario' => [
                'id' => $usuario->id,
                'nombre' => $usuario->nombre,
                'correo' => $usuario->correo,
                'rol' => $usuario->rol->nombre
            ]
        ];
    }
}
