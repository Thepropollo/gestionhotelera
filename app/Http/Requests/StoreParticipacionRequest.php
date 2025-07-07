<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipacionRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'reserva_id'      => 'required|exists:reservas,id',
            'usuario_id'      => 'required|exists:usuarios,id',
            'rol_en_reserva'  => 'required|string|max:100',
            'observaciones'   => 'nullable|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'reserva_id.required'     => 'La reserva es obligatoria.',
            'reserva_id.exists'       => 'La reserva no existe.',
            'usuario_id.required'     => 'El usuario es obligatorio.',
            'usuario_id.exists'       => 'El usuario no existe.',
            'rol_en_reserva.required' => 'El rol en la reserva es obligatorio.',
            'rol_en_reserva.string'   => 'El rol debe ser una cadena de texto.',
            'rol_en_reserva.max'      => 'El rol no puede exceder los 100 caracteres.',
            'observaciones.string'    => 'Las observaciones deben ser una cadena de texto.',
            'observaciones.max'       => 'Las observaciones no pueden exceder los 500 caracteres.'
        ];
    }
}