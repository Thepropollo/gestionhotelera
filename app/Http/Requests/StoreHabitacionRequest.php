<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHabitacionRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'numero'        => 'required|string|max:10|unique:habitacions,numero',
            'tipo'          => 'required|string|max:50',
            'estado'        => 'required|in:disponible,ocupada,mantenimiento',
            'precio_noche'  => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'numero.required'       => 'El número de la habitación es obligatorio.',
            'numero.unique'         => 'Ese número ya está registrado.',
            'tipo.required'         => 'El tipo de habitación es obligatorio.',
            'estado.required'       => 'El estado de la habitación es obligatorio.',
            'estado.in'             => 'El estado debe ser: disponible, ocupada o mantenimiento.',
            'precio_noche.required' => 'El precio por noche es obligatorio.',
            'precio_noche.numeric'  => 'El precio debe ser numérico.',
        ];
    }
}
