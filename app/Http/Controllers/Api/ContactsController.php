<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\StoreContactsRequest;
use App\Http\Requests\UpdateContactsRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contacts;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactsController extends BaseController
{
    /**
     * Listar contactos de un paciente.
     */
    public function contacts($patientId)
{
    $contacts = Contacts::select('contacts.*', 'contact_patient.relationship')
        ->join('contact_patient', 'contacts.id', '=', 'contact_patient.contact_id')
        ->where('contact_patient.patient_id', $patientId)
        ->get();

    return $this->sendResponse($contacts, 'Contactos recuperados con éxito', 200);
}

    /**
     * Agregar un contacto a un paciente.
     */
    public function store(StoreContactsRequest $request, $patientId)
{
    // Verificar si el contacto ya existe por su DNI
    $contact = Contacts::firstOrCreate(
        ['dni' => $request->dni],
        $request->validated() // Esto asegura que solo los campos validados se usen
    );

    // Verificar si ya existe la relación en la tabla pivot
    $exists = DB::table('contact_patient')
        ->where('patient_id', $patientId)
        ->where('contact_id', $contact->id)
        ->exists();

    if (!$exists) {
        // Insertar la relación con el campo "relationship"
        DB::table('contact_patient')->insert([
            'patient_id' => $patientId,
            'contact_id' => $contact->id,
            'relationship' => $request->relationship, // Aquí añadimos correctamente relationship
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    return $this->sendResponse(new ContactResource($contact), 'Contacto añadido con éxito', 201);
}

    /**
     * Actualizar un contacto.
     */
    public function update(UpdateContactsRequest $request, Contacts $contact)
    {
        $contact->update($request->validated());
        return $this->sendResponse(new ContactResource($contact), 'Contacto actualizado con éxito', 201);
    }

    /**
     * Eliminar un contacto.
     */
    public function destroy($contactId)
    {
        // Verificar si el contacto existe
        $contact = Contacts::findOrFail($contactId);

        // Eliminar la relación en la tabla pivot
        DB::table('contact_patient')->where('contact_id', $contactId)->delete();

        // Si el contacto ya no está asociado a ningún paciente, eliminarlo
        $hasRelationships = DB::table('contact_patient')->where('contact_id', $contactId)->exists();
        if (!$hasRelationships) {
            $contact->delete();
        }

        return $this->sendResponse(null, 'Contacto eliminado con éxito', 201);
    }
}
