<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservaRequest;
use App\Http\Requests\UpdateReservaRequest;
use App\Services\ReservaService;
use Illuminate\Http\Request;


class ReservaController extends Controller
{
    protected $reservaService;

    public function __construct(ReservaService $reservaService)
    {
        $this->reservaService = $reservaService;
    }

    public function index()
    {
        return response()->json($this->reservaService->obtenerTodas());
    }

    public function store(StoreReservaRequest $request)
    {
        $data = $request->validated();

        $this->reservaService->validarDisponibilidad(
            $data['tipo_reserva'],
            $data['id_objeto'],
            $data['fecha_inicio'],
            $data['fecha_fin']
        );

        return response()->json($this->reservaService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->reservaService->obtenerPorId($id));
    }

    public function update(UpdateReservaRequest $request, $id)
    {
        $data = $request->validated();

        $this->reservaService->validarDisponibilidad(
            $data['tipo_reserva'],
            $data['id_objeto'],
            $data['fecha_inicio'],
            $data['fecha_fin']
        );

        return response()->json($this->reservaService->actualizar($id, $request->validated()), 201);
    }

    public function destroy($id)
    {
        return response()->json($this->reservaService->eliminar($id));
    }

    // public function cancelar($id)
    // {
    // return response()->json($this->reservaService->cancelar($id));
    // }

    public function reservasPorCliente($clienteId)
    {
        return response()->json($this->reservaService->obtenerPorCliente($clienteId));
    }

    public function asociarParticipantes(Request $request, $reservaId)
    {
        $request->validate([
            'usuarios' => 'required|array|min:1',
            'usuarios.*.usuario_id' => 'required|exists:usuarios,id',
            'usuarios.*.rol_en_reserva' => 'required|string|max:100',
            'usuarios.*.observaciones' => 'nullable|string'
        ]);

        return response()->json(
            $this->reservaService->asociarParticipaciones($reservaId, $request->input('usuarios')),
            201
        );
    }


    public function cancelar($id)
    {
        return response()->json($this->reservaService->cancelarReserva($id));
    }


}

