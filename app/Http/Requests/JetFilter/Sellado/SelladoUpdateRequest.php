<?php

namespace App\Http\Requests\JetFilter\Sellado;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SelladoUpdateRequest extends FormRequest
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
        $filtro_sellado = $this->route('filtro_sellado');
        $rules = [
            'codigo' => [
                'required',
                'string',
                'max:16',
                Rule::unique('filtro_codificacion', 'codigo')->ignore($filtro_sellado->id_filtro),
                Rule::unique('espec_aireautomotriz', 'codigo'),
                Rule::unique('espec_aireindustrial', 'codigo'),
                Rule::unique('espec_combustiblelinea', 'codigo'),
                Rule::unique('espec_elemento', 'codigo'),
                Rule::unique('espec_panel', 'codigo'),
                Rule::unique('espec_sellado', 'codigo')->ignore($filtro_sellado),
            ],
            'diametro_ext' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'diametro_int' => [
                'required',
                'string', 
            ],
            'altura' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'diametroempext' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'diametroempint' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'espesoremp' => [
                'required',
                'numeric', 
                'min:0',
            ],
            'valvulaal' => [
                'required',
                'boolean', 
            ],
            'valvulaad' => [
                'required',
                'boolean', 
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
            'diametro_ext.min' => 'El campo Diametro Externo no puede ser menor a 0',
            'diametro_int.required' => 'El campo Diametro Interno es requerido',
            'diametroempext.required' => 'El campo Diametro Emp Externo es requerido',
            'diametroempext.numeric' => 'Ingreso un valor no Numerico en el campo Diametro Emp Externo',
            'diametroempext.min' => 'El campo Diametro Emp Externo no puede ser menor a 0',
            'diametroempint.required' => 'El campo Diametro Emp Interno es requerido',
            'diametroempint.numeric' => 'Ingreso un valor no Numerico en el campo Diametro Emp Interno',
            'diametroempint.min' => 'El campo Diametro Emp Interno no puede ser menor a 0',
            'espesoremp.required' => 'El campo Espesor Emp es requerido',
            'espesoremp.numeric' => 'Ingreso un valor no Numerico en el campo Espesor Emp',
            'espesoremp.min' => 'El campo Espesor Emp no puede ser menor a 0',
            'altura.required' => 'El campo Altura es requerido',
            'altura.numeric' => 'Ingreso un valor no Numerico en el campo Altura',
            'altura.min' => 'El campo Altura no puede ser menor a 0',
            'imagen1' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen2' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen3' => 'Una o más imagenes no tienen las dimensiones adecuadas',
            'imagen4' => 'Una o más imagenes no tienen las dimensiones adecuadas',
        ];
    }
}
