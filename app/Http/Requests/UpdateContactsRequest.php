<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class UpdateContactsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $dateMin = Carbon::now()->subYears(18)->format('Y-m-d');

        return [
            'dni' => [
                'required', 'string', 'max:255',
                Rule::unique('contacts', 'dni')->ignore($this->contact)
            ],
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => [
                'required', 'string',
                Rule::unique('contacts', 'phone_number')->ignore($this->contact)
            ],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('contacts', 'email')->ignore($this->contact)
            ],
            'relationship' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'dni.required' => 'El campo "DNI" es obligatorio.',
            'dni.unique' => 'El "DNI" ya está en uso.',
            'name.required' => 'El campo "Nombre" es obligatorio.',
            'address.required' => 'El campo "Dirección" es obligatorio.',
            'phone_number.required' => 'El campo "Número de teléfono" es obligatorio.',
            'phone_number.unique' => 'El "Número de teléfono" ya está en uso.',
            'email.required' => 'El campo "Email" es obligatorio.',
            'email.email' => 'El campo "Email" debe ser una dirección válida.',
            'email.unique' => 'El "Email" ya está en uso.',
            'relationship.required' => 'El campo "Relación" es obligatorio.',
        ];
    }
}
