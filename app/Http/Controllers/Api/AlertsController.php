<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AlertResource;
use App\Models\Alert;
use Illuminate\Http\Request;

class AlertsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(Alert::with('type.category')->paginate(50), 'Lista de alertas recuperada con éxito');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlertRequest $request)
    {
        $patient = Patient::create($request->validated());
        return $this->sendResponse($patient, 'Paciente creado con éxito', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alert $alert)
    {
        return $this->sendResponse(new AlertResource($alert->load('type.category')), 'Alerta recuperada con éxito', 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alert $alert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alert $alert)
    {
        //
    }
}
