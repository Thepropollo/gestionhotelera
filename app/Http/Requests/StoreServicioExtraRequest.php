<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicioExtraRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:100|unique:servicio_extras,nombre',
            'precio' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del servicio extra es obligatorio.',
            'nombre.unique'   => 'Este servicio extra ya existe.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric'  => 'El precio debe ser numérico.',
            'precio.min'      => 'El precio debe ser mayor o igual a 0.'
        ];
    }
}
