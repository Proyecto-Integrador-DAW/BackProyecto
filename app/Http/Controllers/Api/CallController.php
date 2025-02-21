<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\CallResource;
    use App\Http\Requests\Api\{
        StoreCallRequest,
        UpdateCallRequest
    };
    use App\Models\Call;
    use Illuminate\Http\Request;

    class CallController extends BaseController {

    /**
     * @OA\Get(
     *     path="/api/calls",
     *     summary="Muestra todas las llamadas paginadas",
     *     tags={"Calls"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de llamadas",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/CallResource")
     *             ),
     *             @OA\Property(property="links", type="object",
     *                 @OA\Property(property="first", type="string", example="http://localhost/api/calls?page=1"),
     *                 @OA\Property(property="last", type="string", example="http://localhost/api/calls?page=3"),
     *                 @OA\Property(property="prev", type="string", example="null"),
     *                 @OA\Property(property="next", type="string", example="http://localhost/api/calls?page=2")
     *             ),
     *             @OA\Property(property="meta", type="object",
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="from", type="integer", example=1),
     *                 @OA\Property(property="last_page", type="integer", example=3),
     *                 @OA\Property(property="path", type="string", example="http://localhost/api/calls"),
     *                 @OA\Property(property="per_page", type="integer", example=15),
     *                 @OA\Property(property="to", type="integer", example=15),
     *                 @OA\Property(property="total", type="integer", example=45)
     *             )
     *         )
     *     )
     * )
     */
        public function index() {
            return CallResource::collection(Call::paginate(20));
        }

        /**
     * @OA\Post(
     *     path="/api/calls",
     *     summary="Crea una nueva llamada",
     *     tags={"Calls"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreCallRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Llamada creada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/CallResource")
     *     )
     * )
     */
        public function store(StoreCallRequest $request) {
            $call = Call::create($request->validated());
            return $this->sendResponse(new CallResource($call), 'Llamada creada con éxito', 201);
        }

        /**
     * @OA\Get(
     *     path="/api/calls/{id}",
     *     summary="Muestra una llamada",
     *     tags={"Calls"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la llamada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Llamada recuperada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/CallResource")
     *     )
     * )
     */
        public function show(Call $call) {
            return $this->sendResponse(new CallResource($call), 'Llamada mostrada con éxito', 200);
        }

        /**
     * @OA\Put(
     *     path="/api/calls/{id}",
     *     summary="Actualiza una llamada",
     *     tags={"Calls"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la llamada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateCallRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Llamada actualizada con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/CallResource")
     *     )
     * )
     */
        public function update(UpdateCallRequest $request, Call $call) {
            $call->update($request->validated());
            return $this->sendResponse(new CallResource($call), 'Llamada actualizada con éxito', 200);
        }

        /**
     * @OA\Delete(
     *     path="/api/calls/{id}",
     *     summary="Elimina una llamada",
     *     tags={"Calls"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la llamada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Llamada eliminada con éxito"
     *     )
     * )
     */
        public function destroy(Call $call) {
            $call->delete();
            return $this->sendResponse(null, 'Llamada eliminada con éxito', 204);
        }
    }
?>