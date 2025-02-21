<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *     schema="UpdateAlertRequest",
 *     description="Validación para la actualización de alertas",
 *     required={"alert_subtype_id", "title", "description", "frequency", "zone_id"},
 *     
 *     @OA\Property(
 *         property="alert_subtype_id",
 *         type="integer",
 *         description="ID del subtipo de alerta",
 *         example=3
 *     ),
 *     
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         maxLength=255,
 *         description="Título de la alerta",
 *         example="Alerta de emergencia"
 *     ),
 *     
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Descripción detallada de la alerta",
 *         example="El paciente ha activado el botón de emergencia."
 *     ),
 *     
 *     @OA\Property(
 *         property="frequency",
 *         type="string",
 *         enum={"Puntual", "Diaria", "Varios días", "Semanal", "Mensual"},
 *         description="Frecuencia de la alerta",
 *         example="Diaria"
 *     ),
 *     
 *     @OA\Property(
 *         property="days_of_week",
 *         type="string",
 *         nullable=true,
 *         description="Días de la semana en los que se activa la alerta (JSON válido)",
 *     ),
 *     
 *     @OA\Property(
 *         property="zone_id",
 *         type="integer",
 *         description="ID de la zona asociada a la alerta",
 *         example=2
 *     )
 * )
 */
    class UpdateAlertRequest extends FormRequest {

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
                'alert_subtype_id' => 'required|exists:alert_subtypes,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'frequency' => 'required|in:Puntual,Diaria,Varios días,Semanal,Mensual',
                'days_of_week' => 'nullable|json',
                'zone_id' => 'required|exists:zones,id',
            ];
        }

        public function messages() {
            return [
                'alert_subtype_id.required' => 'El subtipo de alerta es obligatorio.',
                'alert_subtype_id.exists' => 'El subtipo de alerta seleccionado no existe.',

                'title.required' => 'El título es obligatorio.',
                'title.string' => 'El título debe ser una cadena de texto.',
                'title.max' => 'El título no debe tener más de 255 caracteres.',

                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser una cadena de texto.',

                'frequency.required' => 'La frecuencia es obligatoria.',
                'frequency.in' => 'La frecuencia seleccionada no es válida. Debe ser: "Puntual", "Diaria", "Varios días", "Semanal" o "Mensual".',

                'days_of_week.json' => 'Los días de la semana deben ser un JSON válido.',

                'zone_id.required' => 'La zona es obligatoria.',
                'zone_id.exists' => 'La zona seleccionada no existe.',
            ];            
        }
    }
?>