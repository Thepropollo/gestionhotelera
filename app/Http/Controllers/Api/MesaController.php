<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMesaRequest;
use App\Http\Requests\UpdateMesaRequest;
use App\Services\MesaService;

class MesaController extends Controller
{
    protected $mesaService;

    public function __construct(MesaService $mesaService)
    {
        $this->mesaService = $mesaService;
    }

    public function index()
    {
        return response()->json($this->mesaService->obtenerTodos());
    }

    public function store(StoreMesaRequest $request)
    {
        return response()->json($this->mesaService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->mesaService->obtenerPorId($id));
    }

    public function update(UpdateMesaRequest $request, $id)
    {
        return response()->json($this->mesaService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->mesaService->eliminar($id));
    }
}
