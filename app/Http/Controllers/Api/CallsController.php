<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calls;
use Illuminate\Http\Request;

class CallsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Calls::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCallsRequest $request)
    {
        $call = Calls::create($request->validated());
        return $this->sendResponse($call, 'Cridada Creada amb èxit', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patients $patient)
    {
        return $this->sendResponse(new PatientResource($equip), 'Equip Recuperat amb exit', 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calls $calls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calls $calls)
    {
        //
    }
}
