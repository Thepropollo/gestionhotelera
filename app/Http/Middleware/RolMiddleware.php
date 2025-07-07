<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $usuario = $request->user();

        if (!$usuario || !$usuario->rol || !in_array($usuario->rol->nombre, $roles)) {
            return response()->json([
                'error' => 'Acceso no autorizado',
                'mensaje' => 'Tu rol no tiene permiso para acceder a esta ruta.',
                'rol_actual' => $usuario?->rol?->nombre ?? 'Sin rol'
            ], 403);
        }

        return $next($request);
    }
}
