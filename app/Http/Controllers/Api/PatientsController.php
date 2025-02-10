<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\PatientResource;
use App\Http\Requests\StorePatientsRequest;
use App\Http\Requests\UpdatePatientsRequest;
use App\Models\Patients;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Patients::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientsRequest $request)
    {
        $patient = Patients::create($request->validated());
        return $this->sendResponse($patient, 'Paciente creado con éxito', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patients $patient)
    {
        return $this->sendResponse(new PatientResource($patient), 'Paciente recuperado con éxito', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientsRequest $request, Patients $patient)
    {
        $patient->update($request->validated());
        return $this->sendResponse($patient, 'Paciente actualizado con éxito', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patients $patient)
    {
        $patient->delete();
        return $this->sendResponse(null, 'Paciente borrado con éxito', 201);
    }
}
