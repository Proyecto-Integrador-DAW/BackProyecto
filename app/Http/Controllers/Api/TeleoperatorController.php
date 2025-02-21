<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\TeleoperatorResource;
    use App\Http\Requests\Api\{
        UpdateTeleoperatorRequest,
        StoreTeleoperatorRequest
    };
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Teleoperator;
    use App\Models\User;
use Illuminate\Http\Request;

    class TeleoperatorController extends BaseController {

        /**
     * @OA\Get(
     *     path="/api/teleoperators",
     *     summary="Muestra todos los teleoperadores paginados",
     *     tags={"Teleoperators"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de teleoperadores",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/TeleoperatorResource")
     *             )
     *         )
     *     )
     * )
     */
        public function index() {
            return TeleoperatorResource::collection(Teleoperator::paginate(10));
        }

        /**
     * @OA\Post(
     *     path="/api/teleoperators",
     *     summary="Crea un nuevo teleoperador",
     *     tags={"Teleoperators"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreTeleoperatorRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Teleoperador creado con éxito",
     *         @OA\JsonContent(
     *             @OA\Property(property="teleoperator", ref="#/components/schemas/TeleoperatorResource"),
     *             @OA\Property(property="token", type="string")
     *         )
     *     )
     * )
     */
        public function store(StoreTeleoperatorRequest $request) {

            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            $teleoperator = Teleoperator::create($data);


            $teleoperator->languages()->attach($data['languages']);


            $authUser = User::where('email', $teleoperator->email)->firstOrFail();
            $token = $authUser->createToken('MyAuthApp')->plainTextToken;

            $result = [
                'teleoperator' => new TeleoperatorResource($teleoperator),
                'token' => $token
            ];

            return $this->sendResponse($result, 'Teleoperador creado con éxito', 201);
        }

        /**
     * @OA\Get(
     *     path="/api/teleoperators/{id}",
     *     summary="Muestra un teleoperador",
     *     tags={"Teleoperators"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del teleoperador",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Teleoperador recuperado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/TeleoperatorResource")
     *     )
     * )
     */
        public function show(Teleoperator $teleoperator) {
            return $this->sendResponse(new TeleoperatorResource($teleoperator), 'Teleoperador mostrado con éxito', 200);
        }

        /**
     * @OA\Put(
     *     path="/api/teleoperators/{id}",
     *     summary="Actualiza un teleoperador",
     *     tags={"Teleoperators"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del teleoperador",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateTeleoperatorRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Teleoperador actualizado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/TeleoperatorResource")
     *     )
     * )
     */
        public function update(UpdateTeleoperatorRequest $request, Teleoperator $teleoperator) {

            $data = $request->validated();

            $teleoperator->update($data);

            // ASOCIAMIENTO DE LOS IDIOMAS MODIFICADOS
            if (isset($data['languages'])) {
                $teleoperator->languages()->sync($data['languages']);
            }

            return $this->sendResponse(new TeleoperatorResource($teleoperator), 'Teleoperador actualizado con éxito', 200);
        }

        /**
     * @OA\Delete(
     *     path="/api/teleoperators/{id}",
     *     summary="Elimina un teleoperador",
     *     tags={"Teleoperators"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del teleoperador",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Teleoperador eliminado con éxito"
     *     )
     * )
     */
        public function destroy(Teleoperator $teleoperator) {
            $teleoperator->languages()->detach();
            $teleoperator->delete();
            return $this->sendResponse(null, 'Teleoperador eliminado con éxito', 204);
        }
    }
?>