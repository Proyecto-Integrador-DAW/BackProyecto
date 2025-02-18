<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;

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