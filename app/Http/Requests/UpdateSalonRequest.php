<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalonRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $id = $this->route('salon');
        return [
            'nombre'          => "sometimes|required|string|max:100|unique:salons,nombre,{$id}",
            'capacidad'       => 'sometimes|required|integer|min:1',
            'estado'          => 'sometimes|required|in:disponible,ocupado,mantenimiento',
            'precio_alquiler' => 'sometimes|required|numeric|min:0'
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
            'estado.in'                => 'Estado inválido.',
            'precio_alquiler.required' => 'El precio es obligatorio.',
            'precio_alquiler.numeric'  => 'El precio debe ser numérico.',
        ];
    }
}