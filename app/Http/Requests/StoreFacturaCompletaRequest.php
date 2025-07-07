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

        // Reservas completas
        'reservas' => 'required|array|min:1',
        'reservas.*.tipo_reserva' => 'required|in:habitacion,mesa,salon',
        'reservas.*.id_objeto' => 'required|integer|min:1',
        'reservas.*.fecha_inicio' => 'required|date|after_or_equal:today',
        'reservas.*.fecha_fin' => 'required|date|after:reservas.*.fecha_inicio',

        // Servicios extra (tabla correcta: servicios_extras)
        'servicios_extra' => 'nullable|array',
        'servicios_extra.*.servicio_extra_id' => 'required|exists:servicio_extras,id',
        'servicios_extra.*.cantidad' => 'required|numeric|min:1',

        'descuento' => 'nullable|numeric|min:0'
    ];
}


    public function messages(): array
    {
        return [
            'cliente_id.required' => 'El cliente es obligatorio.',
            'usuario_id.required' => 'El usuario es obligatorio.',
            'reservas.required'   => 'Debe incluir al menos una reserva.',
            'reservas.*.exists'   => 'Una de las reservas no existe.',
            'servicios_extra.*.servicio_id.exists' => 'Un servicio extra no existe.',
            'servicios_extra.*.cantidad.min' => 'La cantidad debe ser al menos 1.',
        ];
    }
}
