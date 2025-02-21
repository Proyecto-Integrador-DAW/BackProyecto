<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *     schema="StorePatientRequest",
 *     description="Validación para la creación de pacientes",
 *     required={"dni", "name", "birth_date", "address", "phone_number", "health_card", "email", "zone_id", "personal_situation", "health_situation", "housing_situation", "economic_situation", "autonomy"},
 *     
 *     @OA\Property(
 *         property="dni",
 *         type="string",
 *         maxLength=255,
 *         description="DNI del paciente (único)",
 *         example="12345678A"
 *     ),
 *     
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=255,
 *         description="Nombre del paciente",
 *         example="Juan Pérez"
 *     ),
 *     
 *     @OA\Property(
 *         property="birth_date",
 *         type="string",
 *         format="date",
 *         description="Fecha de nacimiento del paciente",
 *         example="1985-06-15"
 *     ),
 *     
 *     @OA\Property(
 *         property="address",
 *         type="string",
 *         maxLength=255,
 *         description="Dirección del paciente",
 *         example="Calle Mayor 123, Madrid"
 *     ),
 *     
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         maxLength=255,
 *         description="Número de teléfono del paciente (único)",
 *         example="+34678901234"
 *     ),
 *     
 *     @OA\Property(
 *         property="health_card",
 *         type="string",
 *         maxLength=255,
 *         description="Número de tarjeta sanitaria (único)",
 *         example="HC123456789"
 *     ),
 *     
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         maxLength=255,
 *         description="Correo electrónico del paciente (único)",
 *         example="juan.perez@example.com"
 *     ),
 *     
 *     @OA\Property(
 *         property="zone_id",
 *         type="integer",
 *         description="ID de la zona a la que pertenece el paciente",
 *         example=1
 *     ),
 *     
 *     @OA\Property(
 *         property="personal_situation",
 *         type="string",
 *         maxLength=255,
 *         description="Situación personal del paciente",
 *         example="Vive solo"
 *     ),
 *     
 *     @OA\Property(
 *         property="health_situation",
 *         type="string",
 *         maxLength=255,
 *         description="Situación de salud del paciente",
 *         example="Diabetes tipo 2"
 *     ),
 *     
 *     @OA\Property(
 *         property="housing_situation",
 *         type="string",
 *         maxLength=255,
 *         description="Situación de vivienda del paciente",
 *         example="Piso de alquiler"
 *     ),
 *     
 *     @OA\Property(
 *         property="economic_situation",
 *         type="string",
 *         maxLength=255,
 *         description="Situación económica del paciente",
 *         example="Pensión de jubilación"
 *     ),
 *     
 *     @OA\Property(
 *         property="autonomy",
 *         type="string",
 *         maxLength=255,
 *         description="Grado de autonomía del paciente",
 *         example="Autónomo con asistencia ocasional"
 *     ),
 *     
 *     @OA\Property(
 *         property="emergency_contacts",
 *         type="array",
 *         description="Lista de IDs de contactos de emergencia asociados al paciente",
 *         @OA\Items(type="integer", example=5)
 *     )
 * )
 */
    class StorePatientRequest extends FormRequest {

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
                'dni' => 'required|string|max:255|unique:patients,dni',
                'name' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255|unique:patients,phone_number',
                'health_card' => 'required|string|max:255|unique:patients,health_card',
                'email' => 'required|string|email|max:255|unique:patients,email',
                'zone_id' => 'required|exists:zones,id',
                'personal_situation' => 'required|string|max:255',
                'health_situation' => 'required|string|max:255',
                'housing_situation' => 'required|string|max:255',
                'economic_situation' => 'required|string|max:255',
                'autonomy' => 'required|string|max:255',
                'emergency_contacts' => 'nullable|array',
                'emergency_contacts.*' => 'exists:emergency_contacts,id'
            ];
        }

        public function messages(): array {
            return [
                'dni.required' => 'El DNI es obligatorio.',
                'dni.unique' => 'El DNI ya está registrado.',

                'name.required' => 'El nombre es obligatorio.',

                'birth_date.required' => 'La fecha de nacimiento es obligatoria.',

                'address.required' => 'La dirección es obligatoria.',

                'phone_number.required' => 'El número de teléfono es obligatorio.',
                'phone_number.unique' => 'El número de teléfono ya está registrado.',

                'health_card.required' => 'La tarjeta sanitaria es obligatoria.',
                'health_card.unique' => 'La tarjeta sanitaria ya está registrada.',

                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico debe ser válido.',
                'email.unique' => 'El correo electrónico ya está registrado.',

                'zone_id.required' => 'La zona es obligatoria.',
                'zone_id.exists' => 'La zona seleccionada no existe.',

                'personal_situation.required' => 'La situación personal es obligatoria.',

                'health_situation.required' => 'La situación de salud es obligatoria.',

                'housing_situation.required' => 'La situación de vivienda es obligatoria.',

                'economic_situation.required' => 'La situación económica es obligatoria.',

                'autonomy.required' => 'La autonomía es obligatoria.',

                'emergency_contacts.array' => 'El formato de los contactos de emergencia no es válido.',
                'emergency_contacts.*.exists' => 'Uno o más contactos de emergencia seleccionados no existen.'
            ];
        }
    }
?>