<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsolidarFacturaRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
    return [
        'cliente_id' => 'required|exists:clientes,id',
        'reserva_ids' => 'required|array|min:1',
        'reserva_ids.*' => 'exists:reservas,id',
        'usuario_id' => 'required|exists:usuarios,id',
        'descuento' => 'nullable|numeric|min:0',
    ];
    }

}
