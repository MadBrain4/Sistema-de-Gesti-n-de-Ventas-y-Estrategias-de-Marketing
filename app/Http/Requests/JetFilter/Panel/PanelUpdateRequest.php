<?php

namespace App\Http\Requests\JetFilter\Panel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PanelUpdateRequest extends FormRequest
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
        $filtro_panel = $this->route('filtro_panel');
        $rules = [
            'codigo' => [
                'required',
                'string',
                'max:16',
                Rule::unique('filtro_codificacion', 'codigo')->ignore($filtro_panel->id_filtro),
                Rule::unique('espec_aireautomotriz', 'codigo'),
                Rule::unique('espec_aireindustrial', 'codigo'),
                Rule::unique('espec_combustiblelinea', 'codigo'),
                Rule::unique('espec_elemento', 'codigo'),
                Rule::unique('espec_panel', 'codigo')->ignore($filtro_panel),
                Rule::unique('espec_sellado', 'codigo'),
            ],
            'largo' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'ancho' => [
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
            'largo.required' => 'El campo Largo es requerido',
            'largo.numeric' => 'Ingreso un valor no Numerico en el campo Largo',
            'largo.decimal' => 'El campo Largo tiene que tener máximo 2 decimales',
            'largo.min' => 'El campo Largo no puede ser menor a 0',
            'ancho.required' => 'El campo Ancho es requerido',
            'ancho.numeric' => 'Ingreso un valor no Numerico en el campo Ancho',
            'ancho.decimal' => 'El campo Ancho tiene que tener máximo 2 decimales',
            'ancho.min' => 'El campo Ancho no puede ser menor a 0',
            'altura.required' => 'El campo Altura es requerido',
            'altura.numeric' => 'Ingreso un valor no Numerico en el campo Altura',
            'altura.decimal' => 'El campo Altura tiene que tener máximo 2 decimales',
            'altura.min' => 'El campo Altura no puede ser menor a 0',
            'imagen1' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen2' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen3' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen4' => 'Una o más imagenes no tienen las dimensiones adecuadas',
        ];
    }
}
