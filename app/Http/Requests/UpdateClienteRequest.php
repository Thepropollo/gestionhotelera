<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('cliente');

        return [
            'nombre'   => 'sometimes|required|string|max:255',
            'cedula'   => "sometimes|required|string|max:10|unique:clientes,cedula,{$id}",
            'telefono' => 'sometimes|required|string|max:20',
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
