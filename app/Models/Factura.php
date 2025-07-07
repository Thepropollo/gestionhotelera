<?php

// app/Models/Factura.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';

    protected $fillable = [
        'cliente_id', 'usuario_id', 'fecha',
        'subtotal', 'impuesto', 'descuento', 'total', 'estado_pago'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function detalles()
{
    return $this->hasMany(DetalleFactura::class);
}

    public function detalleFacturas()
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }
}
