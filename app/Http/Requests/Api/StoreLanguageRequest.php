<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreLanguageRequest extends FormRequest {

        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array {
            return [
                'name' => 'required|string|max:50|unique:languages,name',
            ];
        }

        public function messages(): array {
            return [
                'name.required' => 'El nombre del idioma es obligatorio.',
                'name.string' => 'El nombre del idioma debe ser una cadena de texto.',
                'name.max' => 'El nombre del idioma no puede superar los 50 caracteres.',
                'name.unique' => 'El idioma ya está registrado.',
            ];
        }
    }
?>