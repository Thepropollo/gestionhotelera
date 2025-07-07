<?php

namespace App\Repositories;

use App\Models\ServicioExtra;

class ServicioExtraRepository
{
    public function all()
    {
        return ServicioExtra::all();
    }

    public function find($id)
    {
        return ServicioExtra::findOrFail($id);
    }

    public function create(array $data)
    {
        return ServicioExtra::create($data);
    }

    public function update($id, array $data)
    {
        $extra = ServicioExtra::findOrFail($id);
        $extra->update($data);
        return $extra;
    }

    public function delete($id)
    {
        return ServicioExtra::findOrFail($id)->delete();
    }
}
