<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\ZoneResource;
    use App\Http\Resources\PatientResource;
    use App\Http\Resources\CallResource;
    use App\Http\Requests\Api\{
        StoreZoneRequest,
        UpdateZoneRequest
    };
    use App\Models\Zone;
    use Illuminate\Http\Request;

    class ZoneController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return ZoneResource::collection(Zone::paginate(100));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreZoneRequest $request) {
            $zone = Zone::create($request->validated());
            return $this->sendResponse(new ZoneResource($zone), 'Zona creada con éxito', 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Zone $zone) {
            return $this->sendResponse(new ZoneResource($zone), 'Zona mostrada con éxito', 200);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateZoneRequest $request, Zone $zone) {
            $zone->update($request->validated());
            return $this->sendResponse(new ZoneResource($zone), 'Zona actualizada con éxito', 200);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Zone $zone) {
            $zone->delete();
            return $this->sendResponse(null, 'Zona eliminada con éxito', 204);
        }


        public function patients(Zone $zone) {

            if ($zone->patients()->paginate(10)->isEmpty()) {
                return $this->sendResponse(null, 'No hay pacientes asignados en esta zona', 204);
            }

            return PatientResource::collection($zone->patients()->paginate(10));
        }
    
        public function teleoperators(Zone $zone) {

            if ($zone->operators()->paginate(10)->isEmpty()) {
                return $this->sendResponse(null, 'No hay teleoperadores asignados en esta zona', 204);
            }

            return CallResource::collection($zone->operators()->paginate(10));
        }
    }
?>