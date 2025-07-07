<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $id = $this->route('usuario');
        return [
            'nombre'   => 'sometimes|required|string|max:255',
            'correo'   => "sometimes|required|email|unique:usuarios,correo,{$id}",
            'password' => 'sometimes|nullable|string|min:6|max:30',
            'rol_id'   => 'sometimes|integer|required|exists:rols,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'   => 'El nombre es obligatorio.',
            'correo.required'   => 'El correo es obligatorio.',
            'correo.email'      => 'El correo debe ser válido.',
            'correo.unique'     => 'Ese correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'rol_id.required'   => 'Debe seleccionar un rol.',
            'rol_id.integer'     => 'El rol debe ser un número.',
            'rol_id.exists'     => 'El rol no existe.'
        ];
    }
}

