<?php

namespace App\Repositories;

use App\Models\Servicio;

class ServicioRepository
{
    public function all()
    {
        return Servicio::all();
    }

    public function find($id)
    {
        return Servicio::findOrFail($id);
    }

    public function create(array $data)
    {
        return Servicio::create($data);
    }

    public function update($id, array $data)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->update($data);
        return $servicio;
    }

    public function delete($id)
    {
        return Servicio::findOrFail($id)->delete();
    }
}
