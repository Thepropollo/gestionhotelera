<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSalonRequest;
use App\Http\Requests\UpdateSalonRequest;
use App\Services\SalonService;

class SalonController extends Controller
{
    protected $salonService;

    public function __construct(SalonService $salonService)
    {
        $this->salonService = $salonService;
    }

    public function index()
    {
        return response()->json($this->salonService->obtenerTodos());
    }

    public function store(StoreSalonRequest $request)
    {
        return response()->json($this->salonService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->salonService->obtenerPorId($id));
    }

    public function update(UpdateSalonRequest $request, $id)
    {
        return response()->json($this->salonService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->salonService->eliminar($id));
    }
}
