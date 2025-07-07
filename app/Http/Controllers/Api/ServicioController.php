<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use App\Services\ServicioService;

class ServicioController extends Controller
{
    protected $servicioService;

    public function __construct(ServicioService $servicioService)
    {
        $this->servicioService = $servicioService;
    }

    public function index()
    {
        return response()->json($this->servicioService->obtenerTodos());
    }

    public function store(StoreServicioRequest $request)
    {
        return response()->json($this->servicioService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->servicioService->obtenerPorId($id));
    }

    public function update(UpdateServicioRequest $request, $id)
    {
        return response()->json($this->servicioService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->servicioService->eliminar($id));
    }
}
