<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'correo'    => 'required|email',
            'password'  => 'required|string|min:6'
        ];
    }

    public function messages()
    {
        return [
            'correo.required'    => 'El correo electrónico es obligatorio.',
            'correo.email'       => 'El formato del correo electrónico no es válido.',
            'password.required'  => 'La contraseña es obligatoria.',
            'password.min'       => 'La contraseña debe tener al menos 6 caracteres.'
        ];
    }
}

