<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalleReservaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'cantidad'     => 'sometimes|required|integer|min:1',
            'precio_total' => 'sometimes|required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'cantidad.required'     => 'La cantidad es obligatoria.',
            'cantidad.integer'      => 'Debe ser un número entero.',
            'cantidad.min'          => 'Debe ser al menos 1.',
            'precio_total.required' => 'El precio total es obligatorio.',
            'precio_total.numeric'  => 'Debe ser un número.',
        ];
    }
}
