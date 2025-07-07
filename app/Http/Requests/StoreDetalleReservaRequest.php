<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetalleReservaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'reserva_id'       => 'required|exists:reservas,id',
            'servicio_extra_id' => 'required|exists:servicio_extras,id',
            'cantidad'          => 'required|integer|min:1',
            'precio_total'      => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'servicio_extra_id.required' => 'Debes seleccionar un servicio extra.',
            'servicio_extra_id.exists'   => 'El servicio extra no existe.',
            'cantidad.required'          => 'La cantidad es obligatoria.',
            'cantidad.integer'           => 'Debe ser un número entero.',
            'cantidad.min'               => 'Debe ser al menos 1.',
            'precio_total.numeric'       => 'El precio total debe ser un número.',
            'precio_total.min'           => 'El precio total no puede ser negativo.',
            'precio_total.required'      => 'El precio total es obligatorio si se especifica.',
            'reserva_id.required'        => 'La reserva es obligatoria.',
            'reserva_id.exists'          => 'La reserva especificada no existe.',
            'reserva_id.integer'         => 'El ID de la reserva debe ser un número entero.',
        ];
    }
}
