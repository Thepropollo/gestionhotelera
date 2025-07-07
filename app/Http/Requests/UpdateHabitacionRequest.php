<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHabitacionRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $id = $this->route('habitacion');
        return [
            'numero'        => "sometimes|required|string|max:10|unique:habitacions,numero,{$id}",
            'tipo'          => 'sometimes|required|string|max:50',
            'estado'        => 'sometimes|required|in:disponible,ocupada,mantenimiento',
            'precio_noche'  => 'sometimes|required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'numero.required'       => 'El número de la habitación es obligatorio.',
            'numero.unique'         => 'Ese número ya está registrado.',
            'tipo.required'         => 'El tipo de habitación es obligatorio.',
            'estado.required'       => 'El estado de la habitación es obligatorio.',
            'estado.in'             => 'Estado no válido.',
            'precio_noche.required' => 'El precio por noche es obligatorio.',
            'precio_noche.numeric'  => 'El precio debe ser numérico.',
        ];
    }
}

