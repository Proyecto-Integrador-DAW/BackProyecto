<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\EmergencyContactResource;
    use App\Http\Requests\Api\{
        StoreEmergencyContactRequest,
        UpdateEmergencyContactRequest
    };
    use App\Models\EmergencyContact;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Http\Request;

    class EmergencyContactController extends BaseController {

        /**
     * @OA\Get(
     *     path="/api/contacts",
     *     summary="Muestra todos los contactos de emergencia paginados",
     *     tags={"Emergency Contacts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de contactos de emergencia",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/EmergencyContactResource")
     *             )
     *         )
     *     )
     * )
     */
        public function index() {
            return EmergencyContactResource::collection(EmergencyContact::paginate(100));
        }

        /**
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="Crea un nuevo contacto de emergencia",
     *     tags={"Emergency Contacts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreEmergencyContactRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Contacto de emergencia creado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/EmergencyContactResource")
     *     )
     * )
     */
        public function store(StoreEmergencyContactRequest $request) {

            $data = $request->validated();

            $data['created_by'] = Auth::user()->id;

            $contact = EmergencyContact::create($data);
            if (isset($data['patients'])) {
                $contact->patients()->attach($data['patients']);
            }

            return $this->sendResponse(new EmergencyContactResource($contact), 'Contacto de emergencia creado con éxito', 201);
        }

        /**
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     summary="Muestra un contacto de emergencia",
     *     tags={"Emergency Contacts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del contacto de emergencia",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contacto de emergencia mostrado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/EmergencyContactResource")
     *     )
     * )
     */
        public function show(EmergencyContact $emergencyContact) {
            return $this->sendResponse(new EmergencyContactResource($emergencyContact), 'Contacto de emergencia mostrado con éxito', 200);
        }

        /**
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     summary="Actualiza un contacto de emergencia",
     *     tags={"Emergency Contacts"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del contacto de emergencia",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateEmergencyContactRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contacto de emergencia actualizado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/EmergencyContactResource")
     *     )
     * )
     */
        public function update(UpdateEmergencyContactRequest $request, EmergencyContact $emergencyContact) {

            $data = $request->validated();

            $emergencyContact->update($data);

            if (isset($data['patients'])) {
                $emergencyContact->patients()->sync($data['patients']);
            }

            return $this->sendResponse(new EmergencyContactResource($emergencyContact), 'Contacto de emergencia actualizado con éxito', 200);
        }

            /**
     * @OA\Delete(
     *     path="/api/contacts/{id}",
     *     summary="Elimina un contacto de emergencia",
     *     tags={"Emergency Contacts"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del contacto de emergencia",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Contacto de emergencia eliminado con éxito"
     *     )
     * )
     */
        public function destroy(EmergencyContact $emergencyContact) {
            $emergencyContact->patients()->detach();
            $emergencyContact->delete();
            return $this->sendResponse(null, 'Contacto de emergencia eliminado con éxito', 204);
        }
    }
?>