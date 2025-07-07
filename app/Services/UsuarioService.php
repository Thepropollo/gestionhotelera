<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioService
{
    protected $repo;

    public function __construct(UsuarioRepository $repo)
    {
        $this->repo = $repo;
    }

    public function obtenerTodos()
    {
        return $this->repo->all();
    }

    public function obtenerPorId($id)
    {
        return $this->repo->find($id);
    }

    public function crear(array $data)
    {
        return $this->repo->create($data);
    }

    public function actualizar($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function eliminar($id)
    {
        return $this->repo->delete($id);
    }
}
