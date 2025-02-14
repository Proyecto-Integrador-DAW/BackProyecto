<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\ZoneResource;
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
            return $this->sendResponse(new ZoneResource($zone), 'Zona mostrada con éxito', 201);
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
    }
?>