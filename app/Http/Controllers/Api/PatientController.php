<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\PatientResource;
    use App\Http\Requests\Api\{
        StorePatientRequest,
        UpdatePatientRequest
    };
    use App\Models\Patient;
    use App\Models\EmergencyContact;
    use Illuminate\Http\Request;

    use Illuminate\Support\Facades\DB;

    class PatientController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index(Request $request) {
            $zoneName = $request->query('zone');
            $cityName = $request->query('city');
        
            $pacientes = Patient::query()
                ->when($zoneName, function ($query) use ($zoneName) {
                    $query->whereHas('zone', function ($q) use ($zoneName) {
                        $q->where('zone', $zoneName);
                    });
                })
                ->when($cityName, function ($query) use ($cityName) {
                    $query->whereHas('zone', function ($q) use ($cityName) {
                        $q->where('city', $cityName);
                    });
                })
                ->paginate(10);
        
            return PatientResource::collection($pacientes);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StorePatientRequest $request) {

            $data = $request->validated();

            $patient = Patient::create($data);

            if (isset($data['emergency_contacts'])) {
                $patient->emergencyContacts()->attach($data['emergency_contacts']);
            }

            return $this->sendResponse(new PatientResource($patient), 'Paciente creado con éxito', 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Patient $patient) {
            return $this->sendResponse(new PatientResource($patient), 'Paciente mostrado con éxito', 200);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdatePatientRequest $request, Patient $patient) {
            $patient->update($request->validated());
            return $this->sendResponse($patient, 'Paciente actualizado con éxito', 200);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Patient $patient) {
            $patient->emergencyContacts()->detach();
            $patient->delete();
            return $this->sendResponse(null, 'Paciente borrado con éxito', 204);
        }
    }
?>