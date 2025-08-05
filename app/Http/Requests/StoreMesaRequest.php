<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMesaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'numero' => 'required|string|max:10|unique:mesas,numero',
            'capacidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,ocupada,mantenimiento'
        ];
    }

    public function messages()
    {
        return [
            'numero.required' => 'El número de la mesa es obligatorio.',
            'numero.unique' => 'Ese número ya está registrado.',
            'capacidad.required' => 'La capacidad es obligatoria.',
            'capacidad.integer' => 'La capacidad debe ser un número entero.',
            'capacidad.min' => 'Debe haber al menos 1 asiento.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'Estado inválido. Usa: disponible, ocupada o mantenimiento.'
        ];
    }
}
