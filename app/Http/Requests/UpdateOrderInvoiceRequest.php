<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderInvoiceRequest extends FormRequest
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
            'invoice' => 'required|file|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'invoice.required' => 'La factura de la orden es un campo obligatorio',
            'invoice.file' => 'La factura debe ser un archivo',
            'invoice.mimes' => 'La factura debe ser un archivo en formato PDF',
        ];
    }
}
