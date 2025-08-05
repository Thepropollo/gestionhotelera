<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_reserva' => 'required|in:habitacion,mesa,salon',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estado' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ];

        // Validación dinámica del objeto según el tipo
        switch ($this->input('tipo_reserva')) {
            case 'habitacion':
                $rules['id_objeto'] = 'required|exists:habitacions,id';
                break;
            case 'mesa':
                $rules['id_objeto'] = 'required|exists:mesas,id';
                break;
            case 'salon':
                $rules['id_objeto'] = 'required|exists:salons,id';
                break;
            default:
                $rules['id_objeto'] = 'required';
                break;
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente no existe.',
            'tipo_reserva.required' => 'El tipo de reserva es obligatorio.',
            'tipo_reserva.in' => 'Tipo inválido: habitacion, salon o mesa.',
            'id_objeto.required' => 'El ID del objeto reservado es obligatorio.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.after' => 'La fecha fin debe ser posterior a la fecha de inicio.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
