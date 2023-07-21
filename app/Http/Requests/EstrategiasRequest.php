<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstrategiasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_final' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_inicio.required' => 'El campo Fecha Inicio es requerido',
            'fecha_final.required' => 'El campo Fecha Final es requerido',
        ];
    }
}
