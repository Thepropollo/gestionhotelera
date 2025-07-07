<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServicioRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        $id = $this->route('servicio');
        return [
            'nombre'      => "sometimes|required|string|max:100|unique:servicios,nombre,{$id}",
            'descripcion' => 'sometimes|required|string'
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

