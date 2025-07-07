<?php

namespace App\Repositories;

use App\Models\Rol;

class RolRepository
{
    public function all()
    {
        return Rol::all();
    }

    public function find($id)
    {
        return Rol::findOrFail($id);
    }

    public function create(array $data)
    {
        return Rol::create($data);
    }

    public function update($id, array $data)
    {
        $rol = Rol::findOrFail($id);
        $rol->update($data);
        return $rol;
    }

    public function delete($id)
    {
        return Rol::findOrFail($id)->delete();
    }
}
