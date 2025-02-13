<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Zones;
use App\Http\Resources\ZoneResource;
use App\Models\Teleoperators;
use App\Models\Patients;
use Illuminate\Http\Request;

class ZonesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Zones::paginate(10);
    }

    /**
     * Display the specified resource.
     */
    public function show(Zones $zone)
    {
        return $this->sendResponse(new ZoneResource($zone), 'Zona recuperada con éxito', 201);
    }

    public function patients($id)
    {
        $patients = Patients::where('zone_id', $id)->get();
        return $this->sendResponse($patients, 'Pacientes de la zona recuperados con éxito', 200);
    }

    
    public function operators($id)
    {
        $operators = Teleoperators::where('zone_id', $id)->get();

        return $this->sendResponse($operators, 'Operadores de la zona recuperados con éxito', 200);
    }
}
