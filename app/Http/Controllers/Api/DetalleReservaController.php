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

    public function __construct(DetalleReservaService $detalleService)
    {
        $this->detalleService = $detalleService;
    }


    public function store(StoreDetalleReservaRequest $request, $reservaId)
    {
        return $this->detalleService->agregarServicioExtra($reservaId, $request->validated());
    }


    public function index($reservaId)
    {
        return response()->json(
            $this->detalleService->obtenerPorReserva($reservaId)
        );
    }

}
