<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParticipacionRequest;
use App\Http\Requests\UpdateParticipacionRequest;
use App\Services\ParticipacionService;

class ParticipacionController extends Controller
{
    protected $participacionService;

    public function __construct(ParticipacionService $participacionService)
    {
        $this->participacionService = $participacionService;
    }

    public function index()
    {
        return response()->json($this->participacionService->obtenerTodas());
    }

    public function store(StoreParticipacionRequest $request)
    {
        return response()->json($this->participacionService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->participacionService->obtenerPorId($id));
    }

    public function update(UpdateParticipacionRequest $request, $id)
    {
        return response()->json($this->participacionService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->participacionService->eliminar($id));
    }
}
