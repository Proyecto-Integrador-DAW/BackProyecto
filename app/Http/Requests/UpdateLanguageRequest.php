<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
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
    public function rules(): array {
        return [
            'name' => 'required|string|max:255|unique:languages,name',
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'El nombre del idioma es obligatorio.',
            'name.string' => 'El nombre del idioma debe ser una cadena de texto.',
            'name.max' => 'El nombre del idioma no puede superar los 255 caracteres.',
            'name.unique' => 'Este idioma ya existe en la base de datos.',
        ];
    }
}