<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Services\ClienteService;

class ClienteController extends Controller
{
    protected $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        return response()->json($this->clienteService->obtenerTodos());
    }

    public function store(StoreClienteRequest $request)
    {
        return response()->json($this->clienteService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->clienteService->obtenerPorId($id));
    }

    public function update(UpdateClienteRequest $request, $id)
    {
        return response()->json($this->clienteService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->clienteService->eliminar($id));
    }
}
