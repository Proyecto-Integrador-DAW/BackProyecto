<?php

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreContactRequest;
    use App\Http\Requests\UpdateContactRequest;
    use App\Models\EmergencyContact;
    use App\Models\Teleoperator;

    class EmergencyContactController extends Controller {

        use AuthorizesRequests;

        public function index() {

            if (auth()->user()->role === 'administrador') {
                $emergencyContacts = EmergencyContact::withTrashed()->get();
            } else {
                $emergencyContacts = EmergencyContact::all();
            }

            return view('contacts.index', compact('emergencyContacts'));
        }
    
        public function show(EmergencyContact $contact) {
            return view('contacts.show', compact('contact'));
        }
    
        public function create() {
            $this->authorize('create', EmergencyContact::class);
            return view('contacts.create');
        }
    
        public function edit(EmergencyContact $contact) {
            $this->authorize('edit', $contact);
            return view('contacts.edit', compact('contact'));
        }

        public function destroy(EmergencyContact $contact) {

            $this->authorize('delete', $contact);

            $contact->delete();
            return redirect()->route('contacts.index')->with('success', '¡Contacto borrado correctamente!');
        }
        
        public function store(StoreContactRequest $request) {

            $this->authorize('edit', EmergencyContact::class);

            $validated = $request->validated();

            $validated['created_by'] = Auth::id();

            $contact = EmergencyContact::create($validated);

            return redirect()->route('contacts.index')
                ->with('success', '¡Contacto creado correctamente!')
                ->with('id', $contact->id);
        }

        public function update(UpdateContactRequest $request, EmergencyContact $contact) {

            $this->authorize('edit', $contact);

            $validated = $request->validated();

            $contact->update($validated);

            return redirect()->route('contacts.index')
                ->with('success', '¡Contacto actualizado correctamente!')
                ->with('id', $contact->id);
        }

        public function restore($id) {

            $this->authorize('restore', EmergencyContact::class);

            $contact = EmergencyContact::withTrashed()->findOrFail($id);

            $this->authorize('restore', $contact);

            $contact->restore();

            return redirect()->route('contacts.index')
                ->with('success', 'Contacto restaurado correctamente!')
                ->with('id', $contact->id);
        }

        public function forceDelete($id) {

            $this->authorize('forceDelete', EmergencyContact::class);

            $contact = EmergencyContact::withTrashed()->findOrFail($id);

            $this->authorize('forceDelete', $contact);

            // $contact->calls()->forceDelete();
            $contact->forceDelete();

            return redirect()->route('contacts.index')->with('success', 'Contacto eliminado permanentemente.');
        }
    }
?>