<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'tipo_reserva' => 'sometimes|required|in:habitacion,salon,mesa',
            'id_objeto'    => 'sometimes|required|integer|min:1',
            'fecha_inicio' => 'sometimes|required|date|after_or_equal:today',
            'fecha_fin'    => 'sometimes|required|date|after:fecha_inicio',
            'estado'       => 'sometimes|required|in:pendiente,confirmada,cancelada'
        ];
    }

    public function messages()
    {
        return [
            'tipo_reserva.required' => 'El tipo de reserva es obligatorio.',
            'tipo_reserva.in'       => 'Tipo inválido: habitacion, salon o mesa.',
            'id_objeto.required'    => 'El ID del objeto reservado es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.after'       => 'La fecha fin debe ser posterior a la fecha de inicio.',
            'estado.required'       => 'El estado es obligatorio.',
        ];
    }
}
