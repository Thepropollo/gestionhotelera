<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalonRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'nombre'          => 'required|string|max:100|unique:salons,nombre',
            'capacidad'       => 'required|integer|min:1',
            'estado'          => 'required|in:disponible,ocupado,mantenimiento',
            'precio_alquiler' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'          => 'El nombre es obligatorio.',
            'nombre.unique'            => 'Ese nombre ya está registrado.',
            'capacidad.required'       => 'La capacidad es obligatoria.',
            'capacidad.integer'        => 'La capacidad debe ser un número entero.',
            'estado.required'          => 'El estado es obligatorio.',
            'estado.in'                => 'Estado inválido. Usa: disponible, ocupado o mantenimiento.',
            'precio_alquiler.required' => 'El precio de alquiler es obligatorio.',
            'precio_alquiler.numeric'  => 'El precio debe ser numérico.',
        ];
    }
}

