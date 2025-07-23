<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetalleReservaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'servicio_extra_id' => 'required|exists:servicio_extras,id',
            'cantidad' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'servicio_extra_id.required' => 'Debes seleccionar un servicio extra.',
            'servicio_extra_id.exists' => 'El servicio extra seleccionado no existe.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad mínima es 1.',
        ];
    }
}
