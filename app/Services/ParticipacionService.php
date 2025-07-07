<?php

namespace App\Services;

use App\Repositories\ParticipacionRepository;

class ParticipacionService
{
    protected $repo;

    public function __construct(ParticipacionRepository $repo)
    {
        $this->repo = $repo;
    }

    public function obtenerTodas()
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
