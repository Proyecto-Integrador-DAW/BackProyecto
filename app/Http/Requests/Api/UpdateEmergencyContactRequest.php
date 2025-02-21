<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
/**
 * @OA\Schema(
 *     schema="UpdateEmergencyContactRequest",
 *     description="Validación para la actualización de contactos de emergencia",
 *     required={"name", "phone_number", "relationship"},
 *     
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del contacto de emergencia",
 *         example="Juan Pérez"
 *     ),
 *     
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         description="Número de teléfono del contacto",
 *         example="+34678901234"
 *     ),
 *     
 *     @OA\Property(
 *         property="relationship",
 *         type="string",
 *         description="Relación del contacto con el paciente",
 *         example="Padre"
 *     ),
 *     
 *     @OA\Property(
 *         property="patients",
 *         type="array",
 *         nullable=true,
 *         @OA\Items(type="integer"),
 *         description="Lista de IDs de pacientes asociados",
 *         example={1, 2, 3}
 *     )
 * )
 */
    class UpdateEmergencyContactRequest extends FormRequest {

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
                'name' => 'required|string|max:255',
                'phone_number' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('emergency_contacts', 'phone_number')->ignore($this->route('emergencyContact')->id)
                ],
                'relationship' => 'required|string|max:255',
                'patients' => 'nullable|array',
                'patients.*' => 'exists:patients,id'
            ];
        }
        
        public function messages(): array {
            return [
                'name.required' => 'El nombre es obligatorio.',
                'name.max' => 'El nombre no puede superar los 255 caracteres.',

                'phone_number.required' => 'El número de teléfono es obligatorio.',
                'phone_number.max' => 'El número de teléfono no puede superar los 255 caracteres.',
                'phone_number.unique' => 'El número de teléfono ya está registrado.',

                'relationship.required' => 'La relación es obligatoria.',
                'relationship.max' => 'La relación no puede superar los 255 caracteres.',

                'patients.array' => 'El paciente debe ser un array.',
                'patients.*.exists' => 'Uno o varios pacientes seleccionados no existen.'
            ];
        }
    }
?>