<?php

namespace App\Http\Requests\JetFilter\Categoria;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoria extends FormRequest
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
        $rules = [
            'categoria' => [
                'required',
                'max:64',
                'string',
                Rule::unique('categorias', 'nombre')->where(function ($query) {
                    return $query->where('id_producto', $this->producto)->where('id_clase', $this->clase)->whereNull('deleted_at');
                }),
            ],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'categoria.unique' => 'La categoria ya existe',
        ];
    }
}
