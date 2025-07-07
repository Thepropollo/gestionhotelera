<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacturaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'fecha'        => 'sometimes|required|date',
            'subtotal'     => 'sometimes|required|numeric|min:0',
            'impuesto'     => 'sometimes|required|numeric|min:0',
            'descuento'    => 'sometimes|required|numeric|min:0',
            'total'        => 'sometimes|required|numeric|min:0',
            'estado_pago'  => 'sometimes|required|in:pendiente,abonado,pagado'
        ];
    }

    public function messages()
    {
        return [
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