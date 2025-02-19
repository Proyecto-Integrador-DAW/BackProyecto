<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Zone;

class PatientController extends Controller
{
    use AuthorizesRequests;

    public function index() {
        $patients = Patient::all();

        return view('patients.index', compact('patients'));
    }
   
    public function show() {
        return view('patients.show');
    }
   
    public function create() {
        $this->authorize('create', Patient::class);
        $zones = Zone::all(); 
        return view('patients.create', compact('zones'));
    }
   
    public function edit(Patient $patient) {
        $this->authorize('update', $patient);
        $zones = Zone::all();
        return view('patients.edit', compact('patient', 'zones'));
    }

    public function destroy(Patient $patient) {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Paciente borrado correctamente!');
    }
    
    public function store(StorePatientRequest $request)
{
    $validated = $request->validated();

    Patient::create($validated);

    return redirect()->route('patients.index')->with('success', 'Pacient creado correctamente!');
}

public function update(UpdatePatientRequest $request, Patient $patient)
{
    $this->authorize('update', $patient);
      
    $validated = $request->validated();
    
    $patient->update($validated);

    return redirect()->route('patients.index')->with('success', 'Pacient actualizado correctamente!');
}

public function delete(Patient $patient)
{
    $patient->delete();
    return redirect()->route('patients.index')->with('success', 'Pacient borrado correctamente!');
}
}