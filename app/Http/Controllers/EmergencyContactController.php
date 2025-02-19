<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\EmergencyContact;
use App\Models\Teleoperator;

class EmergencyContactController extends Controller
{
    use AuthorizesRequests;

    public function index() {
        $emergencyContacts = EmergencyContact::all();
        return view('contacts.index', compact('emergencyContacts'));
    }
   
    public function show(EmergencyContact $contact) {
        return view('contacts.show', compact('contact'));
    }
   
    public function create() {
        $this->authorize('create', EmergencyContact::class);
        $teleoperators = Teleoperator::all();
        return view('contacts.create', compact('teleoperators'));
    }
   
    public function edit(EmergencyContact $contact) {
        $this->authorize('update', $contact);
        return view('contacts.edit', compact('contact'));
    }

    public function destroy(EmergencyContact $contact) {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Idioma borrado correctamente!');
    }
    
    public function store(StoreContactRequest $request)
{
    $validated = $request->validated();
    $validated['created_by'] = Auth::id();
    EmergencyContact::create($validated);

    return redirect()->route('contacts.index')->with('success', 'Idioma creado correctamente!');
}

public function update(UpdateContactRequest $request, EmergencyContact $contact)
{
    $this->authorize('update', $contact);
      
    $validated = $request->validated();
    
    $contact->update($validated);

    return redirect()->route('contacts.index')->with('success', 'Idioma actualizado correctamente!');
}

public function delete(EmergencyContact $contact)
{
    $contact->delete();
    return redirect()->route('contacts.index')->with('success', 'Idioma borrado correctamente!');
}
}