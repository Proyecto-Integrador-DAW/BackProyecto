<?php

    namespace App\Http\Controllers;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Http\Request;
    use App\Http\Requests\StorePatientRequest;
    use App\Http\Requests\UpdatePatientRequest;
    use App\Models\Patient;
    use App\Models\Zone;
    use App\Models\Teleoperator;

    class PatientController extends Controller {

        use AuthorizesRequests;

        public function index() {

            if (auth()->user()->role === 'administrador') {
                $patients = Patient::withTrashed()->get();
            } else {
                $patients = Patient::all();
            }

            return view('patients.index', compact('patients'));
        }
    
        public function show(Patient $patient) {
            return view('patients.show', compact('patient'));
        }
    
        public function create() {

            $this->authorize('create', Patient::class);

            $zones = Zone::all();
            $teleoperators = Teleoperator::all();
            return view('patients.create', compact('zones', 'teleoperators'));
        }
    
        public function edit(Patient $patient) {

            $this->authorize('edit', $patient);

            $zones = Zone::all();
            $teleoperators = Teleoperator::all();
            return view('patients.edit', compact('patient', 'zones', 'teleoperators'));
        }

        public function destroy(Patient $patient) {

            $this->authorize('delete', $patient);

            $patient->delete();
            return redirect()->route('patients.index')->with('success', '¡Paciente borrado correctamente!');
        }
        
        public function store(StorePatientRequest $request) {

            $this->authorize('create', Patient::class);

            $validated = $request->validated();

            $patient = Patient::create($validated);

            return redirect()->route('patients.index')
                ->with('success', '¡Paciente creado correctamente!')
                ->with('id', $patient->id);
        }

        public function update(UpdatePatientRequest $request, Patient $patient) {

            $this->authorize('edit', $patient);
            
            $validated = $request->validated();
            
            $patient->update($validated);

            return redirect()->route('patients.index')
                ->with('success', '¡Paciente actualizado correctamente!')
                ->with('id', $patient->id);
        }

        public function restore($id) {

            $this->authorize('restore', Patient::class);

            $pacient = Patient::withTrashed()->findOrFail($id);

            $this->authorize('restore', $pacient);

            $pacient->restore();

            return redirect()->route('patients.index')
                ->with('success', '¡Paciente restaurado correctamente!')
                ->with('id', $pacient->id);
        }

        public function forceDelete($id) {

            $this->authorize('forceDelete', Patient::class);

            $pacient = Patient::withTrashed()->findOrFail($id);

            $this->authorize('forceDelete', $pacient);

            $pacient->calls()->forceDelete();
            $pacient->forceDelete();

            return redirect()->route('patients.index')->with('success', 'Paciente eliminado permanentemente.');
        }
    }
?>