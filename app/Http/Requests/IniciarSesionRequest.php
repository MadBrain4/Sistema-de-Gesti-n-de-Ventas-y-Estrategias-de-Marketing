<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IniciarSesionRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function getCredentials(){
        return $this->only('email','password');
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El correo es requerido',
            'password.required' => 'La contraseña es requerida',
            'email.email' => 'El correo no cumple con el formato',
            'password.min' => 'La contraseña debe tener minímo 8 caracteres',
        ];
    }
}
