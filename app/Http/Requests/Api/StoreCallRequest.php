<?php

    namespace App\Http\Requests\Api;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreCallRequest extends FormRequest {

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
                'teleoperator_id' => 'required|exists:teleoperators,id',
                'patient_id' => 'required|exists:patients,id',
                'call_type' => 'required|in:Entrante,Saliente',
                'type' => 'required|in:Emergencia social,Emergencia sanitaria,Crisis soledad,Alarma sin respuesta,Comunicacion no urgente,Notificar absencia,Modificar datos personales,Llamada accidental,Peticion informacion,Sugerencia queja reclamacion,Llamada social,Registrar cita medica,Planificada,No planificada,Otros',
                'call_time' => 'required|date',
                'description' => 'nullable|string',
                'alert_id' => 'nullable|exists:alerts,id',
            ];
        }

        public function messages(): array {
            return [
                'teleoperator_id.required' => 'El campo teleoperador es obligatorio.',
                'teleoperator_id.exists' => 'El teleoperador seleccionado no es válido.',

                'patient_id.required' => 'El campo paciente es obligatorio.',
                'patient_id.exists' => 'El paciente seleccionado no es válido.',

                'call_type.required' => 'El campo tipo de llamada es obligatorio.',
                'call_type.in' => 'El tipo de llamada debe ser "Entrante" o "Saliente".',

                'type.required' => 'El campo tipo es obligatorio.',
                'type.in' => 'El tipo debe ser uno de los valores permitidos: "Emergencia social", "Emergencia sanitaria", "Crisis soledad", "Alarma sin respuesta", "Comunicacion no urgente", "Notificar absencia", "Modificar datos personales", "Llamada accidental", "Peticion informacion", "Sugerencia queja reclamacion", "Llamada social", "Registrar cita medica", "Planificada", "No planificada", "Otros".',

                'call_time.required' => 'El campo hora de la llamada es obligatorio.',
                'call_time.date' => 'El campo hora de la llamada debe ser una fecha válida.',

                'description.string' => 'El campo descripción debe ser un texto válido.',

                'alert_id.exists' => 'La alerta seleccionada no es válida.',
            ];
        }
    }
?>