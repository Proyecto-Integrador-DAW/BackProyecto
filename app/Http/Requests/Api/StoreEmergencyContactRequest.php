<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreEmergencyContactRequest extends FormRequest {

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
                'phone_number' => 'required|string|max:255|unique:emergency_contacts,phone_number',
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