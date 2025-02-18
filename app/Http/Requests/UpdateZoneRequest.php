<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateZoneRequest extends FormRequest
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
            'city' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
        ];
    }

    public function messages(): array {
        return [
            'city.required' => 'La ciudad es obligatoria.',
            'city.string' => 'La ciudad debe ser una cadena de texto.',
            'city.max' => 'La ciudad no puede superar los 255 caracteres.',
            'zone.required' => 'La zona es obligatoria.',
            'zone.string' => 'La zona debe ser una cadena de texto.',
            'zone.max' => 'La zona no puede superar los 255 caracteres.',
        ];
    }
}
