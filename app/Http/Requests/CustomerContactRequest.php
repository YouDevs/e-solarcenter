<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerContactRequest extends FormRequest
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
            'subject' => 'required',
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
            'subject.required' => 'Por favor proporciona un asunto!',
            'message.required' => 'Por favor escribe un mensaje!',
        ];
    }
}
