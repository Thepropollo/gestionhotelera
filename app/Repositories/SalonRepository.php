<?php

namespace App\Repositories;

use App\Models\Salon;

class SalonRepository
{
    public function all()
    {
        return Salon::all();
    }

    public function find($id)
    {
        return Salon::findOrFail($id);
    }

    public function create(array $data)
    {
        return Salon::create($data);
    }

    public function update($id, array $data)
    {
        $salon = Salon::findOrFail($id);
        $salon->update($data);
        return $salon;
    }

    public function delete($id)
    {
        return Salon::findOrFail($id)->delete();
    }
}
