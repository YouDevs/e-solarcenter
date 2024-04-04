<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntegratorContactRequest extends FormRequest
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
            'email' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'state' => 'required',
            'company' => 'required',
            'rfc' => 'required',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Por favor escribe tu nombre!',
            'email.required' => 'Por favor proporciona un correo valido!',
            'phone.required' => 'Por favor proporciona un teléfono valido!',
            'phone.regex' => 'Por favor proporciona un teléfono valido!',
            'state.required' => 'Por favor proporciona su estado!',
            'company.required' => 'Por favor proporciona su empresa!',
            'rfc.required' => 'Por favor proporciona un RFC válido!',
            'message.required' => 'Por favor escribe un mensaje!',
        ];
    }
}
