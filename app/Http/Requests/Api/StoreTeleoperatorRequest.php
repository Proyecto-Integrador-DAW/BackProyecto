<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *     schema="StoreTeleoperatorRequest",
 *     description="Validación para la creación de teleoperadores",
 *     required={"name", "email", "prefix", "phone_number", "zone_id", "hiring_date", "code", "password", "languages"},
 *     
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         maxLength=255,
 *         description="Nombre del teleoperador",
 *         example="María González"
 *     ),
 *     
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Correo electrónico del teleoperador (único)",
 *         example="maria.gonzalez@example.com"
 *     ),
 *     
 *     @OA\Property(
 *         property="prefix",
 *         type="string",
 *         description="Prefijo telefónico",
 *         example="+34"
 *     ),
 *     
 *     @OA\Property(
 *         property="phone_number",
 *         type="string",
 *         maxLength=20,
 *         description="Número de teléfono del teleoperador (único)",
 *         example="678901234"
 *     ),
 *     
 *     @OA\Property(
 *         property="zone_id",
 *         type="integer",
 *         description="ID de la zona a la que pertenece el teleoperador",
 *         example=2
 *     ),
 *     
 *     @OA\Property(
 *         property="hiring_date",
 *         type="string",
 *         format="date",
 *         description="Fecha de contratación del teleoperador",
 *         example="2024-01-15"
 *     ),
 *     
 *     @OA\Property(
 *         property="code",
 *         type="integer",
 *         description="Código único del teleoperador",
 *         example=12345
 *     ),
 *     
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         minLength=6,
 *         description="Contraseña del teleoperador",
 *         example="secreta123"
 *     ),
 *     
 *     @OA\Property(
 *         property="languages",
 *         type="array",
 *         description="Lista de IDs de idiomas que habla el teleoperador",
 *         @OA\Items(type="integer", example=1)
 *     )
 * )
 */
    class StoreTeleoperatorRequest extends FormRequest {

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
                'email' => 'required|email|unique:teleoperators,email',
                'prefix' => 'required|string',
                'phone_number' => 'required|string|max:20|unique:teleoperators,phone_number',
                'zone_id' => 'required|exists:zones,id',
                'hiring_date' => 'required|date',
                'code' => 'required|integer|unique:teleoperators,code',
                'password' => 'required|string|min:6',
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
                'phone_number.unique' => 'Este número de teléfono ya está registrado.',

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
        
                'languages.required' => 'Debe tener al menos un idioma seleccionado.',
                'languages.array' => 'El formato de los idiomas no es válido.',
                'languages.*.exists' => 'Uno o más idiomas seleccionados no existen.',
            ];
        }
    }
?>