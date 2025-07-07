<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDetalleFacturaRequest;
use App\Http\Requests\UpdateDetalleFacturaRequest;
use App\Services\DetalleFacturaService;

class DetalleFacturaController extends Controller
{
    protected $detalleFacturaService;

    public function __construct(DetalleFacturaService $detalleFacturaService)
    {
        $this->detalleFacturaService = $detalleFacturaService;
    }

    public function index()
    {
        return response()->json($this->detalleFacturaService->obtenerTodos());
    }

    public function store(StoreDetalleFacturaRequest $request)
    {
        return response()->json($this->detalleFacturaService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->detalleFacturaService->obtenerPorId($id));
    }

    public function update(UpdateDetalleFacturaRequest $request, $id)
    {
        return response()->json($this->detalleFacturaService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->detalleFacturaService->eliminar($id));
    }
}
