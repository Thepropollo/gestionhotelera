<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // el nombre de rol solo puede ser Administrador Usuario o Propietario
        return [
            'nombre' => 'required|string|max:100|unique:rols,nombre|in:Administrador,Usuario,Propietario',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del rol es obligatorio.',
            'nombre.unique' => 'Ese rol ya existe.',
            'nombre.max' => 'El nombre del rol no debe pasar los 100 caracteres.',
            'nombre.in' => 'El nombre del rol debe ser uno de los siguientes: Administrador, Usuario, Propietario.',
        ];
    }
}
