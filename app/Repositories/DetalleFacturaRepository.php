<?php

namespace App\Repositories;

use App\Models\DetalleFactura;

class DetalleFacturaRepository
{
    public function all()
    {
        return DetalleFactura::all();
    }

    public function find($id)
    {
        return DetalleFactura::findOrFail($id);
    }

    public function create(array $data)
    {
        return DetalleFactura::create($data);
    }

    public function update($id, array $data)
    {
        $detalle = DetalleFactura::findOrFail($id);
        $detalle->update($data);
        return $detalle;
    }

    public function delete($id)
    {
        return DetalleFactura::findOrFail($id)->delete();
    }
}
