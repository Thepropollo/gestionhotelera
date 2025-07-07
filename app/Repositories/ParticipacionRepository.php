<?php

namespace App\Repositories;

use App\Models\Participacion;

class ParticipacionRepository
{
    public function all()
    {
        return Participacion::all();
    }

    public function find($id)
    {
        return Participacion::findOrFail($id);
    }

    public function create(array $data)
    {
        return Participacion::create($data);
    }

    public function update($id, array $data)
    {
        $part = Participacion::findOrFail($id);
        $part->update($data);
        return $part;
    }

    public function delete($id)
    {
        return Participacion::findOrFail($id)->delete();
    }
}
