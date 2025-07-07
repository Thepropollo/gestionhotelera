<?php

// app/Models/DetalleFactura.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = 'detalle_facturas';

    protected $fillable = ['factura_id', 'descripcion', 'cantidad', 'precio_unitario', 'total_linea'];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }
}
