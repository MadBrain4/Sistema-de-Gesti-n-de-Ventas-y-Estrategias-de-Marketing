<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        date_default_timezone_set('America/Caracas');
        $fecha = date('Y-m-d');
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users_webfiltros,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'genero' => 'required|string',
            'pais' => 'required|string',
            'estado' => 'required|string',
            'direccion' => 'required|string',
            'nacimiento' => "date|before:$fecha",
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El correo es requerido',
            'email.email' => 'El correo no cumple con el formato',
            'email.unique' => 'El correo ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.min_digits' => 'La contraseña debe tener minimo 8 caracteres',
            'password_confirmation.min_digits' => 'La contraseña debe tener minimo 8 caracteres',
            'password_confirmation.same' => 'La contraseña no concuerda',
            'genero.required' => 'El genero es requerido',
            'pais.required' => 'El país es requerido',
            'estado.required' => 'El estado es requerido',
            'direccion.required' => 'La dirección es requerida',
            'nacimiento.date' => 'La fecha de nacimiento debe ser una fecha',
            'nacimiento.before' => 'No tiene la edad suficiente para registrarse',
        ];
    }
}
