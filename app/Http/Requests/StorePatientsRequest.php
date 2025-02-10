<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $dateMin = Carbon::now()->subYears(18)->format('Y-m-d');

        return [
            'dni' => 'required|string|max:255|unique:patients,dni',
            'name' => 'required|string|max:255',
            'birth_date' => "required|date|before:$dateMin",
            'adress' => 'required|string|max:255',
            'phone_number' => 'required|integer|unique:patients,phone_number',
            'health_card' => 'required|string|max:255|unique:patients,health_card',
            'email' => 'required|email|max:255|unique:patients,email',
            'zone_id' => 'required|exists:zones,id',
            'personal_situation' => 'required|string',
            'health_situation' => 'required|string',
            'housing_situation' => 'required|string',
            'economic_situation' => 'required|string',
            'autonomy' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'El campo "DNI" es obligatorio.',
            'dni.unique' => 'El "DNI" ya está en uso.',
            'name.required' => 'El campo "Nombre" es obligatorio.',
            'birth_date.required' => 'El campo "Fecha de nacimiento" es obligatorio.',
            'birth_date.date' => 'El campo "Fecha de nacimiento" debe ser una fecha válida.',
            'birth_date.before' => 'El paciente debe ser mayor de 18 años.',
            'adress.required' => 'El campo "Dirección" es obligatorio.',
            'phone_number.required' => 'El campo "Número de teléfono" es obligatorio.',
            'phone_number.unique' => 'El "Número de teléfono" ya está en uso.',
            'health_card.required' => 'El campo "Tarjeta de salud" es obligatorio.',
            'health_card.unique' => 'La "Tarjeta de salud" ya está en uso.',
            'email.required' => 'El campo "Email" es obligatorio.',
            'email.email' => 'El campo "Email" debe ser una dirección válida.',
            'email.unique' => 'El "Email" ya está en uso.',
            'zone_id.required' => 'El campo "Zona" es obligatorio.',
            'zone_id.exists' => 'La zona seleccionada no es válida.',
            'personal_situation.required' => 'El campo "Situación personal" es obligatorio.',
            'health_situation.required' => 'El campo "Situación de salud" es obligatorio.',
            'housing_situation.required' => 'El campo "Situación de vivienda" es obligatorio.',
            'economic_situation.required' => 'El campo "Situación económica" es obligatorio.',
            'autonomy.required' => 'El campo "Autonomía" es obligatorio.',
        ];
    }
}
