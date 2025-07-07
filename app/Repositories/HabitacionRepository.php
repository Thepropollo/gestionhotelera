<?php

namespace App\Repositories;

use App\Models\Habitacion;

class HabitacionRepository
{
    public function all()
    {
        return Habitacion::all();
    }

    public function find($id)
    {
        return Habitacion::findOrFail($id);
    }

    public function create(array $data)
    {
        return Habitacion::create($data);
    }

    public function update($id, array $data)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->update($data);
        return $habitacion;
    }

    public function delete($id)
    {
        return Habitacion::findOrFail($id)->delete();
    }
}
