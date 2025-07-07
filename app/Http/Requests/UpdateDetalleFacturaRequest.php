<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalleFacturaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'descripcion'     => 'sometimes|required|string|max:255',
            'cantidad'        => 'sometimes|required|integer|min:1',
            'precio_unitario' => 'sometimes|required|numeric|min:0',
            'total_linea'     => 'sometimes|required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required'     => 'La descripción es obligatoria.',
            'cantidad.required'        => 'La cantidad es obligatoria.',
            'cantidad.integer'         => 'La cantidad debe ser un número entero.',
            'cantidad.min'             => 'La cantidad debe ser al menos 1.',
            'precio_unitario.required' => 'El precio unitario es obligatorio.',
            'precio_unitario.numeric'  => 'El precio unitario debe ser numérico.',
            'total_linea.required'     => 'El total de la línea es obligatorio.',
            'total_linea.numeric'      => 'El total de la línea debe ser numérico.'
        ];
    }
}


