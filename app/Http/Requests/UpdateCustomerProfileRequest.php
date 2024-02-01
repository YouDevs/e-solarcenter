<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'password' => 'nullable|confirmed',
            'default_address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es un campo requerido',
            'name.max' => 'El nombre no puede exceder de 255 caracteres',
            'email.required' => 'El correo electrónico es un campo requerido',
            'email.email' => 'El correo electrónico debe tener un formato válido',
            'email.max' => 'El correo electrónico no puede exceder de 255 caracteres',
            'email.unique' => 'El correo electrónico que ingresaste ya se encuentra registrado',
            'password.confirmed' => 'Ingrese dos contraseñas iguales',
            'default_address.required' => 'Seleccionar una dirección de entrega es requerido',
        ];
    }
}
