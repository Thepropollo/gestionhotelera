<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHabitacionRequest;
use App\Http\Requests\UpdateHabitacionRequest;
use App\Services\HabitacionService;

class HabitacionController extends Controller
{
    protected $habitacionService;

    public function __construct(HabitacionService $habitacionService)
    {
        $this->habitacionService = $habitacionService;
    }

    public function index()
    {
        return response()->json($this->habitacionService->obtenerTodos());
    }

    public function store(StoreHabitacionRequest $request)
    {
        return response()->json($this->habitacionService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->habitacionService->obtenerPorId($id));
    }

    public function update(UpdateHabitacionRequest $request, $id)
    {
        return response()->json($this->habitacionService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->habitacionService->eliminar($id));
    }
}