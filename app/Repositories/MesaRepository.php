<?php

namespace App\Repositories;

use App\Models\Mesa;

class MesaRepository
{
    public function all()
    {
        return Mesa::all();
    }

    public function find($id)
    {
        return Mesa::findOrFail($id);
    }

    public function create(array $data)
    {
        return Mesa::create($data);
    }

    public function update($id, array $data)
    {
        $mesa = Mesa::findOrFail($id);
        $mesa->update($data);
        return $mesa;
    }

    public function delete($id)
    {
        return Mesa::findOrFail($id)->delete();
    }
}
