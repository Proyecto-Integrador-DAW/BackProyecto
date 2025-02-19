<?php

namespace App\Http\Controllers;
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
   
    public function show(Language $language) {
        return view('contacts.show', compact('language'));
    }
   
    public function create() {
        $this->authorize('create', Language::class);
        return view('contacts.create');
    }
   
    public function edit(Language $language) {
        $this->authorize('update', $language);
        return view('contacts.edit', compact('language'));
    }

    public function destroy(Language $language) {
        $language->delete();
        return redirect()->route('contacts.index')->with('success', 'Idioma borrado correctamente!');
    }
    
    public function store(StoreLanguageRequest $request)
{
    $validated = $request->validated();

    Language::create($validated);

    return redirect()->route('contacts.index')->with('success', 'Idioma creado correctamente!');
}

public function update(UpdateLanguageRequest $request, Language $language)
{
    $this->authorize('update', $language);
      
    $validated = $request->validated();
    
    $language->update($validated);

    return redirect()->route('contacts.index')->with('success', 'Idioma actualizado correctamente!');
}

public function delete(Language $language)
{
    $language->delete();
    return redirect()->route('contacts.index')->with('success', 'Idioma borrado correctamente!');
}
}