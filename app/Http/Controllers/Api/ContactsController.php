<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contacts;
use App\Models\Patients;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Listar contactos de un paciente.
     */
    public function index($patientId)
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
    public function store(StoreContactRequest $request, $patientId)
    {
        $patient = Patients::findOrFail($patientId);
        $contact = Contacts::create($request->validated());
        $patient->contacts()->attach($contact->id, ['relationship' => $request->relationship]);

        return $this->sendResponse(new ContactResource($contact), 'Contacto añadido con éxito', 201);
    }

    /**
     * Actualizar un contacto.
     */
    public function update(UpdateContactRequest $request, Contacts $contact)
    {
        $contact->update($request->validated());
        return $this->sendResponse(new ContactResource($contact), 'Contacto actualizado con éxito', 200);
    }

    /**
     * Eliminar un contacto.
     */
    public function destroy(Contacts $contact)
    {
        $contact->delete();
        return $this->sendResponse(null, 'Contacto eliminado con éxito', 200);
    }
}
