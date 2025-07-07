<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $id = $this->route('rol');
        return [
            'nombre' => "required|string|max:100|unique:rols,nombre,{$id}"
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del rol es obligatorio.',
            'nombre.unique'   => 'Ese rol ya existe.',
            'nombre.max'      => 'El nombre del rol no debe pasar los 100 caracteres.',
        ];
    }
}

