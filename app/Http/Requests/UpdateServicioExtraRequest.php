<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicioExtraRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $id = $this->route('servicio_extra');

        return [
            'nombre' => "sometimes|required|string|max:100|unique:servicio_extras,nombre,{$id}",
            'precio' => 'sometimes|required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique'   => 'Este nombre ya existe.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric'  => 'El precio debe ser numérico.',
            'precio.min'      => 'El precio debe ser mayor o igual a 0.'
        ];
    }
}
