<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicioRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'nombre'      => 'required|string|max:100|unique:servicios,nombre',
            'descripcion' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'      => 'El nombre del servicio es obligatorio.',
            'nombre.unique'        => 'Este servicio ya existe.',
            'descripcion.required' => 'La descripción es obligatoria.'
        ];
    }
}

