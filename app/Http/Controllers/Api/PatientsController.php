<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\PatientResource;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Support\Facades\Log;

class PatientsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(Patient::paginate(50), 'Lista de pacientes recuperada con éxito');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create($request->validated());
        return $this->sendResponse($patient, 'Paciente creado con éxito', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return $this->sendResponse(new PatientResource($patient), 'Paciente recuperado con éxito', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());
        return $this->sendResponse($patient, 'Paciente actualizado con éxito', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return $this->sendResponse(null, 'Paciente borrado con éxito', 201);
    }
}
