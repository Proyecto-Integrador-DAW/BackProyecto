<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;
/**
 * @OA\Schema(
 *     schema="UpdateTeleoperatorRequest",
 *     description="Validación para la actualización de un teleoperador",
 *     required={"name", "email", "prefix", "phone_number", "zone_id", "hiring_date", "code", "languages"},
 *     
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del teleoperador",
 *         example="Carlos Pérez"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Correo electrónico",
 *         example="carlos.perez@example.com"
 *     ),
 *     @OA\Property(
 *         property="prefix",
 *         type="string",
 *         description="Prefijo telefónico",
 *         example="+34"
 *     ),
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         description="Número de teléfono",
 *         example="600123456"
 *     ),
 *     @OA\Property(
 *         property="zone_id",
 *         type="integer",
 *         description="ID de la zona asignada",
 *         example=2
 *     ),
 *     @OA\Property(
 *         property="hiring_date",
 *         type="string",
 *         format="date",
 *         description="Fecha de contratación",
 *         example="2023-07-15"
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="integer",
 *         description="Código único del teleoperador",
 *         example=1058
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         nullable=true,
 *         description="Contraseña del teleoperador",
 *         example="securepassword123"
 *     ),
 *     @OA\Property(
 *         property="languages",
 *         type="array",
 *         @OA\Items(type="integer", description="ID del idioma", example=1)
 *     )
 * )
 */
    class UpdateTeleoperatorRequest extends FormRequest {

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
                'email' => [
                    'required',
                    'email',
                    Rule::unique('teleoperators', 'email')->ignore($this->route('teleoperator')->id),
                ],
                'prefix' => 'required|string',
                'phone_number' => 'required|string|max:20',
                'zone_id' => 'required|exists:zones,id',
                'hiring_date' => 'required|date',
                'code' => [
                    'required',
                    'number',
                    Rule::unique('teleoperators', 'code')->ignore($this->route('teleoperator')->id),
                ],
                'password' => 'nullable|string|min:6',
                'languages' => 'required|array',
                'languages.*' => 'exists:languages,id'
            ];
        }

        public function messages(): array {
            return [
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser un texto.',
                'name.max' => 'El nombre no puede tener más de 255 caracteres.',

                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico debe ser válido.',
                'email.unique' => 'Este correo electrónico ya está registrado.',

                'prefix.required' => 'El prefijo es obligatorio.',
                'prefix.string' => 'El prefijo debe ser un texto.',

                'phone_number.required' => 'El número de teléfono es obligatorio.',
                'phone_number.string' => 'El número de teléfono debe ser un texto.',
                'phone_number.max' => 'El número de teléfono no puede tener más de 20 caracteres.',

                'zone_id.required' => 'Debe seleccionar una zona.',
                'zone_id.exists' => 'La zona seleccionada no existe.',

                'hiring_date.required' => 'La fecha de contratación es obligatoria.',
                'hiring_date.date' => 'La fecha de contratación debe ser una fecha válida.',

                'code.required' => 'El código es obligatorio.',
                'code.number' => 'El código debe ser un número.',
                'code.unique' => 'Este código ya está en uso.',

                'password.required' => 'La contraseña es obligatoria.',
                'password.string' => 'La contraseña debe ser un texto.',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres.',

                'languages.required' => 'Debe seleccionar al menos un idioma.',
                'languages.array' => 'El formato de los idiomas no es válido.',
                'languages.*.exists' => 'Uno o más idiomas seleccionados no existen.',
            ];
        }
    }
?>