<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacturaCompletaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'usuario_id' => 'required|exists:usuarios,id',

            // Cambiar reservas a array de IDs
            'reservas' => 'required|array|min:1',
            'reservas.*' => 'required|integer|exists:reservas,id',

            // Servicios extra (tabla servicios_extras)
            'servicio_extra' => 'nullable|array',
            'servicio_extra.*.servicio_extra_id' => 'required|exists:servicios_extras,id',
            'servicio_extra.*.cantidad' => 'required|numeric|min:1',

            'descuento' => 'nullable|numeric|min:0'
        ];
    }


    public function messages(): array
    {
        return [
            'cliente_id.required' => 'El cliente es obligatorio.',
            'usuario_id.required' => 'El usuario es obligatorio.',
            'reservas.required' => 'Debe incluir al menos una reserva.',
            'reservas.*.exists' => 'Una de las reservas no existe.',
            'servicios_extra.*.servicio_extra_id.exists' => 'Un servicio extra no existe.',
            'servicios_extra.*.cantidad.min' => 'La cantidad debe ser al menos 1.',
        ];
    }
}

