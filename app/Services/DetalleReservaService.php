<?php

namespace App\Services;
use App\Models\ServicioExtra;
use App\Repositories\DetalleReservaRepository;


class DetalleReservaService
{
    protected $repo;

    public function agregarServicioExtra($reservaId, array $data)
    {
        $precioUnitario = ServicioExtra::findOrFail($data['servicio_extra_id'])->precio;
        $data['reserva_id'] = $reservaId;
        $data['precio_total'] = $precioUnitario * $data['cantidad'];

        return $this->repo->crear($data);
    }

    public function obtenerPorReserva($reservaId)
    {
        return $this->repo->obtenerPorReserva($reservaId);
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

    public function __construct(DetalleReservaRepository $repo)
    {
        $this->repo = $repo;
    }

}
