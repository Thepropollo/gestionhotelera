<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServicioExtraRequest;
use App\Http\Requests\UpdateServicioExtraRequest;
use App\Services\ServicioExtraService;

class ServicioExtraController extends Controller
{
    protected $servicioExtraService;

    public function __construct(ServicioExtraService $servicioExtraService)
    {
        $this->servicioExtraService = $servicioExtraService;
    }

    public function index()
    {
        return response()->json($this->servicioExtraService->obtenerTodos());
    }

    public function store(StoreServicioExtraRequest $request)
    {
        return response()->json($this->servicioExtraService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->servicioExtraService->obtenerPorId($id));
    }

    public function update(UpdateServicioExtraRequest $request, $id)
    {
        return response()->json($this->servicioExtraService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->servicioExtraService->eliminar($id));
    }
}
