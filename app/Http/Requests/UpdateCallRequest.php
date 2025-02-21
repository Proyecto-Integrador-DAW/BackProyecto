<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCallRequest extends FormRequest
{
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
            'title' => 'required|string',
            'description' => 'nullable|string',
            'alert_id' => 'nullable|exists:alerts,id',
        ];
    }

    public function withValidator($validator) {

        $validator->after(function ($validator) {
            $callType = $this->input('call_type');
            $type = $this->input('type');
            $alertId = $this->input('alert_id');

            if (($callType === 'Saliente') && ($type !== 'Planificada' && $type !== 'No planificada')) {
                $validator->errors()->add('type', 'El campo type sólo puede ser "Planificada" o "No planificada" para llamadas salientes.');
            }

            // Si es saliente y planificada, alert_id es obligatorio
            if ($callType === 'Saliente' && $type === 'Planificada' && empty($alertId)) {
                $validator->errors()->add('alert_id', 'El campo alert_id es obligatorio para llamadas salientes planificadas.');
            }

            // Si es entrante, alert_id debe ser NULL y solo puede tener ciertos tipos
            $entranteTypes = [
                'Emergencia social', 'Emergencia sanitaria', 'Crisis soledad',
                'Alarma sin respuesta', 'Comunicacion no urgente', 'Notificar absencia',
                'Modificar datos personales', 'Llamada accidental', 'Peticion informacion',
                'Sugerencia queja reclamacion', 'Llamada social', 'Registrar cita medica', 'Otros'
            ];

            if ($callType === 'Entrante') {
                if (!in_array($type, $entranteTypes, true)) {
                    $validator->errors()->add('type', 'El tipo de llamada entrante debe ser uno de los permitidos.');
                }
                if (!empty($alertId)) {
                    $validator->errors()->add('alert_id', 'Las llamadas entrantes no pueden tener un alert_id.');
                }
            }
        });
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

            'title.string' => 'El campo título debe ser un texto válido.',

            'description.string' => 'El campo descripción debe ser un texto válido.',

            'alert_id.exists' => 'La alerta seleccionada no es válida.',
        ];
    }
}
?>