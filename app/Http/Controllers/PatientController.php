<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\StorePatientsRequest;
use App\Http\Requests\UpdatePatientsRequest;
use App\Models\Patient;

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
        return view('patients.create');
    }
   
    public function edit(Patient $patient) {
        $this->authorize('update', $patient);
        $equips = Equip::all(); 
        return view('patients.edit', compact('estadi','equips'));
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

public function update(UpdatePatientsRequest $request, Patient $patient)
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