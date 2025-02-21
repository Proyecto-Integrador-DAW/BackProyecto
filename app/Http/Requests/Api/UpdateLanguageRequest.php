<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
/**
 * @OA\Schema(
 *     schema="UpdateLanguageRequest",
 *     description="Validación para la actualización de un idioma",
 *     required={"name"},
 *     
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del idioma",
 *         example="Español"
 *     )
 * )
 */
    class UpdateLanguageRequest extends FormRequest {

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
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('languages', 'name')->ignore($this->route('language')->id)
                ],
            ];
        }

        public function messages(): array {
            return [
                'name.required' => 'El nombre del idioma es obligatorio.',
                'name.string' => 'El nombre del idioma debe ser una cadena de texto.',
                'name.max' => 'El nombre del idioma no puede superar los 255 caracteres.',
                'name.unique' => 'El nombre del idioma ya está registrado.',
            ];
        }
    }
?>