<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Zone;
use App\Http\Resources\ZoneResource;
use App\Models\Teleoperator;
use App\Models\Patient;
use Illuminate\Http\Request;

class ZonesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Zone::paginate(10);
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone)
    {
        return $this->sendResponse(new ZoneResource($zone), 'Zona recuperada con éxito', 201);
    }

    public function patients($id)
    {
        $patients = Patient::where('zone_id', $id)->get();
        return $this->sendResponse($patients, 'Pacientes de la zona recuperados con éxito', 200);
    }

    
    public function operators($id)
    {
        $operators = Teleoperator::where('zone_id', $id)->get();

        return $this->sendResponse($operators, 'Operadores de la zona recuperados con éxito', 200);
    }
}
