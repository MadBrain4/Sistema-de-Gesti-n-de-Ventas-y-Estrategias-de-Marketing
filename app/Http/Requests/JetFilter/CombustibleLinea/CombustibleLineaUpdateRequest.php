<?php

namespace App\Http\Requests\JetFilter\CombustibleLinea;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CombustibleLineaUpdateRequest extends FormRequest
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
        $filtro_combustible = $this->route('filtro_combustible');
        $rules = [
            'codigo' => [
                'required',
                'string',
                'max:16',
                Rule::unique('filtro_codificacion', 'codigo')->ignore($filtro_combustible->id_filtro),
                Rule::unique('espec_aireautomotriz', 'codigo'),
                Rule::unique('espec_aireindustrial', 'codigo'),
                Rule::unique('espec_combustiblelinea', 'codigo')->ignore($filtro_combustible),
                Rule::unique('espec_elemento', 'codigo'),
                Rule::unique('espec_panel', 'codigo'),
                Rule::unique('espec_sellado', 'codigo'),
            ],
            'diametro_ext' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'entrada' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'salida' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'altura' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'detalle1' => [
                'string',
                'max:64',
                'nullable',
            ],
            'detalle2' => [
                'string',
                'max:64',
                'nullable',
            ],
            'imagen1' => [
                'dimensions:min_width=1400,max_width=1600,min_height=1200,max_height=1300'
            ],
            'imagen2' => [
                'dimensions:min_width=1400,max_width=1600,min_height=1200,max_height=1300'
            ],
            'imagen3' => [
                'dimensions:min_width=1400,max_width=1600,min_height=1200,max_height=1300'
            ],
            'imagen4' => [
                'dimensions:min_width=1400,max_width=1600,min_height=1200,max_height=1300'
            ],
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'codigo.unique' => 'El codigo ya existe',
            'codigo.max' => 'El codigo supera el númerpo máximo de caracteres',
            'diametro_ext.required' => 'El campo Diametro Externo es requerido',
            'diametro_ext.numeric' => 'Ingreso un valor no Numerico en el campo Diametro Externo',
            'diametro_ext.decimal' => 'El campo Diametro Externo tiene que tener máximo 2 decimales',
            'diametro_ext.min' => 'El campo Diametro Externo no puede ser menor a 0',
            'entrada.required' => 'El campo Entrada es requerido',
            'entrada.numeric' => 'Ingreso un valor no Numerico en el campo Entrada',
            'entrada.decimal' => 'El campo Entrada tiene que tener máximo 2 decimales',
            'entrada.min' => 'El campo Entrada no puede ser menor a 0',
            'salida.required' => 'El campo Salida es requerido',
            'salida.numeric' => 'Ingreso un valor no Numerico en el campo Salida',
            'salida.decimal' => 'El campo Salida tiene que tener máximo 2 decimales',
            'salida.min' => 'El campo Salida no puede ser menor a 0',
            'altura.required' => 'El campo Diametro Externo es requerido',
            'altura.numeric' => 'Ingreso un valor no Numerico en el campo Diametro Externo',
            'altura.decimal' => 'El campo Diametro Externo tiene que tener máximo 2 decimales',
            'altura.min' => 'El campo Diametro Externo no puede ser menor a 0',
            'imagen1' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen2' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen3' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen4' => 'Una o más imagenes no tienen las dimensiones adecuadas',
        ];
    }
}
