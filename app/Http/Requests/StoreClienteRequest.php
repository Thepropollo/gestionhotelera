<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre'   => 'required|string|max:255',
            'cedula'   => 'required|string|max:10|unique:clientes,cedula',
            'telefono' => 'required|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'   => 'El nombre es obligatorio.',
            'cedula.required'   => 'La cédula es obligatoria.',
            'cedula.max'        => 'La cédula no debe tener más de 10 caracteres.',
            'cedula.unique'     => 'La cédula ya está registrada.',
            'telefono.required' => 'El teléfono es obligatorio.',
        ];
    }
}


