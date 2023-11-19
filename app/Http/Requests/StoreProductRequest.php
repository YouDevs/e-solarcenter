<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'brand' => 'required',
            'category_id' => 'required',
            'data_sheet' => 'file|mimes:pdf',
            'featured' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de producto es un campo obligatorio',
            'brand.required' => 'El nombre de la marca es un campo obligatorio',
            'category_id.required' => 'La categoría es un campo obligatorio',
            'data_sheet.file' => 'La ficha técnica debe ser un archivo PDF',
            'data_sheet.mimes' => 'La ficha técnica debe ser un archivo PDF',
            'featured.required' => 'La imagen es un campo obligatorio',
            'featured.image' => 'La imagen debe ser un formato válido (png, jpeg, jpg)',
        ];
    }

}
