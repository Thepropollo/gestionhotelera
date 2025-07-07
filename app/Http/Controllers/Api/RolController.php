<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateRolRequest;
use App\Services\RolService;

class RolController extends Controller
{
    protected $rolService;

    public function __construct(RolService $rolService)
    {
        $this->rolService = $rolService;
    }

    public function index()
    {
        return response()->json($this->rolService->obtenerTodos());
    }

    public function store(StoreRolRequest $request)
    {
        return response()->json($this->rolService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->rolService->obtenerPorId($id));
    }

    public function update(UpdateRolRequest $request, $id)
    {
        return response()->json($this->rolService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->rolService->eliminar($id));
    }
}
