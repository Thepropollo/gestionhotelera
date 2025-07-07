<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaCompletaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'reservas'   => 'required|array|min:1',
            'reservas.*.tipo_reserva' => 'required|in:habitacion,salon,mesa',
            'reservas.*.id_objeto'    => 'required|integer|min:1',
            'reservas.*.fecha_inicio' => 'required|date|after_or_equal:today',
            'reservas.*.fecha_fin'    => 'required|date|required|date',
            'servicios_extra'         => 'array',
            'servicios_extra.*.servicio_extra_id' => 'required|exists:servicio_extras,id',
            'servicios_extra.*.cantidad'          => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required' => 'El cliente es obligatorio.',
            'reservas.required'   => 'Debe haber al menos una reserva.',
            'tipo_reserva.in'     => 'Tipo de reserva inválido.',
        ];
    }
}
