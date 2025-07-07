<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DisponibilidadService;

class DisponibilidadController extends Controller
{
    protected $service;

    public function __construct(DisponibilidadService $service)
    {
        $this->service = $service;
    }

    public function consultar(Request $request)
    {
        $request->validate([
            'tipo'         => 'required|in:habitacion,mesa,salon',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin'    => 'required|date|after:fecha_inicio',
        ]);

        $tipo = $request->input('tipo');
        $inicio = $request->input('fecha_inicio');
        $fin = $request->input('fecha_fin');

        return response()->json($this->service->consultarDisponibilidad($tipo, $inicio, $fin));
    }
}
