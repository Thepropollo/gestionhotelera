<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'cliente_id'   => 'required|exists:clientes,id',
            'reserva_id'   => 'required|exists:reservas,id',
            'usuario_id'   => 'required|exists:usuarios,id',
            'fecha'        => 'required|date',
            'subtotal'     => 'required|numeric|min:0',
            'impuesto'     => 'required|numeric|min:0',
            'descuento'    => 'required|numeric|min:0',
            'total'        => 'required|numeric|min:0',
            'estado_pago'  => 'required|in:pendiente,abonado,pagado'
        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required'   => 'El cliente es obligatorio.',
            'cliente_id.exists'     => 'El cliente no existe.',
            'reserva_id.required'   => 'La reserva es obligatoria.',
            'reserva_id.exists'     => 'La reserva no existe.',
            'usuario_id.required'   => 'El usuario es obligatorio.',
            'usuario_id.exists'     => 'El usuario no existe.',
            'fecha.required'        => 'La fecha es obligatoria.',
            'fecha.date'            => 'La fecha debe ser una fecha válida.',
            'subtotal.required'     => 'El subtotal es obligatorio.',
            'subtotal.numeric'      => 'El subtotal debe ser numérico.',
            'impuesto.required'     => 'El impuesto es obligatorio.',
            'impuesto.numeric'      => 'El impuesto debe ser numérico.',
            'descuento.required'    => 'El descuento es obligatorio.',
            'descuento.numeric'     => 'El descuento debe ser numérico.',
            'total.required'        => 'El total es obligatorio.',
            'total.numeric'         => 'El total debe ser numérico.',
            'estado_pago.required'  => 'El estado de pago es obligatorio.',
            'estado_pago.in'        => 'Estado de pago no válido.'
        ];
    }
}