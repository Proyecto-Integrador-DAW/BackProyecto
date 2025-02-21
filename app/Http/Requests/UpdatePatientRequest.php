<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdatePatientRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'dni' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'dni')->ignore($this->route('patient')->id)
            ],
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'phone_number')->ignore($this->route('patient')->id)
            ],
            'health_card' => [
                'required',
                'string',
                'max:255',
                Rule::unique('patients', 'health_card')->ignore($this->route('patient')->id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('patients', 'email')->ignore($this->route('patient')->id)
            ],
            'zone_id' => 'required|exists:zones,id',
            'associated_teleoperator_id' => 'nullable|exists:teleoperators,id',
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

            'associated_teleoperator_id.exists' => 'El teleoperador asociado no existe.',

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