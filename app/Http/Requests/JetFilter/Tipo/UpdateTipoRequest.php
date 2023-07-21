<?php

namespace App\Http\Requests\JetFilter\Tipo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTipoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if( Auth::check() ){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $tipo = $this->route('tipo');
        $rules = [
            'tipo' => [
                'required',
                'max:64',
                'string',
                Rule::unique('tipos', 'tipo')->where(function ($query) {
                    return $query->where('id_categoria', $this->categoria)->whereNull('deleted_at');
                })->ignore($tipo),
            ],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'tipo.unique' => 'El tipo ya existe',
        ];
    }
}
