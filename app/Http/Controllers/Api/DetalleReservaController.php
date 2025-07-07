<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDetalleReservaRequest;
use App\Http\Requests\UpdateDetalleReservaRequest;
use App\Services\DetalleReservaService;

class DetalleReservaController extends Controller
{
    protected $detalleService;

    public function show($id)
    {
        return response()->json($this->detalleService->obtenerPorId($id));
    }

    public function update(UpdateDetalleReservaRequest $request, $id)
    {
        return response()->json($this->detalleService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->detalleService->eliminar($id));
    }


    public function __construct(DetalleReservaService $service)
    {
        $this->service = $service;
    }

    public function store(StoreDetalleReservaRequest $request)
    {
    $data = $request->validated();
    $reservaId = $data['reserva_id'];

    return response()->json(
        $this->service->agregarServicioExtra($reservaId, $data),
        201
    );
    }


    public function index($reservaId)
    {
        return response()->json(
            $this->service->obtenerPorReserva($reservaId)
        );
    }

}
