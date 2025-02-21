<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\AlertResource;
    use App\Http\Requests\Api\{
        StoreAlertRequest,
        UpdateAlertRequest
    };
    use App\Models\Alert;
    use Illuminate\Http\Request;

    class AlertController extends BaseController {

            /**
     * @OA\Get(
     *     path="/api/alerts",
     *     summary="Muestra todas las alertas paginadas",
     *     tags={"Alerts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de alertas",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/AlertResource")
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
        public function index() {
            return AlertResource::collection(Alert::paginate(40));
        }

          /**
     * @OA\Post(
     *     path="/api/alerts",
     *     summary="Crea una nueva alerta",
     *     tags={"Alerts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreAlertRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Alerta creada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/AlertResource")
     *     )
     * )
     */
        public function store(StoreAlertRequest $request) {
            $alert = Alert::create($request->validated());
            return $this->sendResponse($alert, 'Alerta creada con éxito', 201);
        }

           /**
     * @OA\Get(
     *     path="/api/alerts/{id}",
     *     summary="Muestra una alerta específica",
     *     tags={"Alerts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la alerta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Alerta mostrada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/AlertResource")
     *     )
     * )
     */
        public function show(Alert $alert) {
            return $this->sendResponse(new AlertResource($alert), 'Alerta mostrada con éxito', 200);
        }
        
  /**
     * @OA\Put(
     *     path="/api/alerts/{id}",
     *     summary="Actualiza una alerta",
     *     tags={"Alerts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la alerta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateAlertRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Alerta actualizada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/AlertResource")
     *     )
     * )
     */
        public function update(UpdateAlertRequest $request, Alert $alert) {
            $alert->update($request->validated());
            return $this->sendResponse(new AlertResource($alert), 'Alerta actualizada con éxito', 200);
        }

    /**
     * @OA\Delete(
     *     path="/api/alerts/{id}",
     *     summary="Elimina una alerta",
     *     tags={"Alerts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la alerta",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Alerta eliminada con éxito"
     *     )
     * )
     */
        public function destroy(Alert $alert) {
            $alert->delete();
            return $this->sendResponse(null, 'Alerta eliminada con éxito', 204);
        }
    }
?>