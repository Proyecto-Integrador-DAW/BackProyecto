<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AlertResource;
use App\Models\Warnings;
use Illuminate\Http\Request;

class AlertsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(Warnings::with('type.category')->paginate(50), 'Lista de alertas recuperada con éxito');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarningsRequest $request)
    {
        $patient = Patients::create($request->validated());
        return $this->sendResponse($patient, 'Paciente creado con éxito', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Warnings $alert)
    {
        return $this->sendResponse(new AlertResource($alert->load('type.category')), 'Alerta recuperada con éxito', 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warnings $warnings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warnings $warnings)
    {
        //
    }
}
