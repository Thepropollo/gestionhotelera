<?php

namespace App\Services;

use App\Repositories\DisponibilidadRepository;

class DisponibilidadService
{
    protected $repo;

    public function __construct(DisponibilidadRepository $repo)
    {
        $this->repo = $repo;
    }

    public function consultarDisponibilidad($tipo, $inicio, $fin)
    {
        return $this->repo->recursosDisponibles($tipo, $inicio, $fin);
    }
}
