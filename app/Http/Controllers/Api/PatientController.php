<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\PatientResource;
    use App\Http\Resources\AlertResource;
    use App\Http\Resources\CallResource;
    use App\Http\Requests\Api\{
        StorePatientRequest,
        UpdatePatientRequest
    };
    use App\Models\Patient;
    use Illuminate\Http\Request;

    class PatientController extends BaseController {

    /**
    * @OA\Get(
    *     path="/api/patients",
    *     summary="Muestra todos los pacientes paginados con filtros de zona y ciudad",
    *     tags={"Patients"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="zone",
    *         in="query",
    *         description="Filtrar por zona",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Parameter(
    *         name="city",
    *         in="query",
    *         description="Filtrar por ciudad",
    *         required=false,
    *         @OA\Schema(type="string")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Lista de pacientes",
    *         @OA\JsonContent(
    *             @OA\Property(property="data", type="array",
    *                 @OA\Items(ref="#/components/schemas/PatientResource")
    *             )
    *         )
    *     )
    * )
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
    * @OA\Post(
    *     path="/api/patients",
    *     summary="Crea un nuevo paciente",
    *     tags={"Patients"},
    *     security={{"bearerAuth":{}}},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(ref="#/components/schemas/StorePatientRequest")
    *     ),
    *     @OA\Response(
    *         response=201,
    *         description="Paciente creado con éxito",
    *         @OA\JsonContent(ref="#/components/schemas/PatientResource")
    *     )
    * )
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
    * @OA\Get(
    *     path="/api/patients/{id}",
    *     summary="Muestra un paciente",
    *     tags={"Patients"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del paciente",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Paciente recuperado con éxito",
    *         @OA\JsonContent(ref="#/components/schemas/PatientResource")
    *     )
    * )
    */
        public function show(Patient $patient) {
            return $this->sendResponse(new PatientResource($patient), 'Paciente mostrado con éxito', 200);
        }

    /**
    * @OA\Put(
    *     path="/api/patients/{id}",
    *     summary="Actualiza un paciente",
    *     tags={"Patients"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del paciente",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(ref="#/components/schemas/UpdatePatientRequest")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Paciente actualizado con éxito",
    *         @OA\JsonContent(ref="#/components/schemas/PatientResource")
    *     )
    * )
    */
        public function update(UpdatePatientRequest $request, Patient $patient) {
            $patient->update($request->validated());
            return $this->sendResponse(new PatientResource($patient), 'Paciente actualizado con éxito', 200);
        }

        /**
    * @OA\Delete(
    *     path="/api/patients/{id}",
    *     summary="Elimina un paciente",
    *     tags={"Patients"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del paciente",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=204,
    *         description="Paciente eliminado con éxito"
    *     )
    * )
    */
        public function destroy(Patient $patient) {
            $patient->emergencyContacts()->detach();
            $patient->delete();
            return $this->sendResponse(null, 'Paciente borrado con éxito', 204);
        }


    /**
    * @OA\Get(
    *     path="/api/patients/{id}/calls",
    *     summary="Obtiene las llamadas de un paciente",
    *     tags={"Patients"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del paciente",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Lista de llamadas del paciente",
    *         @OA\JsonContent(
    *             @OA\Property(property="data", type="array",
    *                 @OA\Items(ref="#/components/schemas/CallResource")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=204,
    *         description="No hay pacientes asignados en esta zona"
    *     )
    * )
     */
        public function patientCalls(Patient $patient) {

            if ($patient->calls()->paginate(10)->isEmpty()) {
                return $this->sendResponse(null, 'No hay pacientes asignados en esta zona', 204);
            }

            return CallResource::collection($patient->calls()->paginate(10));
        }

    /**
    * @OA\Get(
    *     path="/api/patients/{id}/alerts",
    *     summary="Obtiene las alertas de un paciente",
    *     tags={"Patients"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID del paciente",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Lista de alertas del paciente",
    *         @OA\JsonContent(
    *             @OA\Property(property="data", type="array",
    *                 @OA\Items(ref="#/components/schemas/AlertResource")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=204,
    *         description="No hay alertas en la zona de este paciente"
    *     )
    * )
     */
        public function alerts(Patient $patient) {

            if ($patient->alerts()->paginate(10)->isEmpty()) {
                return $this->sendResponse(null, 'No hay alertas en la zona de este paciente', 204);
            }

            return AlertResource::collection($patient->alerts()->paginate(10));
        }
    }
?>