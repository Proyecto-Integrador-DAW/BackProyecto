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
     * @OA\Get(
     *     path="/api/zones",
     *     summary="Muestra todas las zonas paginadas",
     *     tags={"Zones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de zonas",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/ZoneResource")
     *             )
     *         )
     *     )
     * )
     */
        public function index() {
            return ZoneResource::collection(Zone::paginate(100));
        }

        /**
     * @OA\Post(
     *     path="/api/zones",
     *     summary="Crea una nueva zona",
     *     tags={"Zones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreZoneRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Zona creada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/ZoneResource")
     *     )
     * )
     */
        public function store(StoreZoneRequest $request) {
            $zone = Zone::create($request->validated());
            return $this->sendResponse(new ZoneResource($zone), 'Zona creada con éxito', 201);
        }

        /**
     * @OA\Get(
     *     path="/api/zones/{id}",
     *     summary="Muestra una zona",
     *     tags={"Zones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zona mostrada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/ZoneResource")
     *     )
     * )
     */
        public function show(Zone $zone) {
            return $this->sendResponse(new ZoneResource($zone), 'Zona mostrada con éxito', 200);
        }

        /**
     * @OA\Put(
     *     path="/api/zones/{id}",
     *     summary="Actualiza una zona",
     *     tags={"Zones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateZoneRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zona actualizada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/ZoneResource")
     *     )
     * )
     */
        public function update(UpdateZoneRequest $request, Zone $zone) {
            $zone->update($request->validated());
            return $this->sendResponse(new ZoneResource($zone), 'Zona actualizada con éxito', 200);
        }

        /**
     * @OA\Delete(
     *     path="/api/zones/{id}",
     *     summary="Elimina una zona",
     *     tags={"Zones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Zona eliminada con éxito"
     *     )
     * )
     */
        public function destroy(Zone $zone) {
            $zone->delete();
            return $this->sendResponse(null, 'Zona eliminada con éxito', 204);
        }


        /**
     * @OA\Get(
     *     path="/api/zones/{id}/patients",
     *     summary="Obtiene los pacientes de una zona",
     *     tags={"Zones"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la zona",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pacientes en la zona",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/PatientResource")
     *             )
     *         )
     *     ),
    *     @OA\Response(
    *         response=204,
    *         description="No hay pacientes asignados en esta zona"
    *     )
    * )
     */
        public function patients(Zone $zone) {

            if ($zone->patients()->paginate(10)->isEmpty()) {
                return $this->sendResponse(null, 'No hay pacientes asignados en esta zona', 204);
            }

            return PatientResource::collection($zone->patients()->paginate(10));
        }
    
         /**
    * @OA\Get(
    *     path="/api/zones/{id}/teleoperators",
    *     summary="Obtiene los teleoperadores de una zona",
    *     tags={"Zones"},
    *     security={{"bearerAuth":{}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID de la zona",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Lista de teleoperadores en la zona",
    *         @OA\JsonContent(
    *             @OA\Property(property="data", type="array",
    *                 @OA\Items(ref="#/components/schemas/CallResource")
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response=204,
    *         description="No hay teleoperadores asignados en esta zona"
    *     )
    * )
     */
        public function teleoperators(Zone $zone) {

            if ($zone->operators()->paginate(10)->isEmpty()) {
                return $this->sendResponse(null, 'No hay teleoperadores asignados en esta zona', 204);
            }

            return CallResource::collection($zone->operators()->paginate(10));
        }
    }
?>