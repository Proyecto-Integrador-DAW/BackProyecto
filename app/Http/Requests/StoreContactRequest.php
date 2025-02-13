<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'dni' => 'required|string|max:255|unique:contacts,dni',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|integer|unique:contacts,phone_number',
            'email' => 'required|email|max:255|unique:contacts,email',
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
