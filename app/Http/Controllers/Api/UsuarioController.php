<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Services\UsuarioService;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    public function index()
    {
        return response()->json($this->usuarioService->obtenerTodos());
    }

    public function store(StoreUsuarioRequest $request)
    {
        return response()->json($this->usuarioService->crear($request->validated()), 201);
    }

    public function show($id)
    {
        return response()->json($this->usuarioService->obtenerPorId($id));
    }

    public function update(UpdateUsuarioRequest $request, $id)
    {
        return response()->json($this->usuarioService->actualizar($id, $request->validated()));
    }

    public function destroy($id)
    {
        return response()->json($this->usuarioService->eliminar($id));
    }
}

