<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRegistrationRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'company_name' => 'required',
            'rfc' => 'required|numeric|regex:/^\d{12,13}$/',
            // 'delivery_address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de contacto es un campo obligatorio',

            'email.required' => 'El correo electrónico es un campo obligatorio',
            'email.email' => 'El correo electrónico debe ser uno valido',

            'company_name' => 'La razón social es un campo obligatorio',

            'rfc.required' => 'El RFC un campo obligatorio',
            'rfc.numeric' => 'El RFC debe tener solo números',
            'rfc.regex' => 'El RFC debe tener entre 12 y 13 digitos.',

            // 'delivery_address' => 'La dirección de entrega es un campo obligatorio',
        ];
    }
}
