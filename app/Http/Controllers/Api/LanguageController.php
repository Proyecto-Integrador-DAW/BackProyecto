<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\LanguageResource;
    use App\Http\Requests\Api\{
        StoreLanguageRequest,
        UpdateLanguageRequest
    };
    use App\Models\Language;
    use Illuminate\Http\Request;

    class LanguageController extends BaseController {

           /**
     * @OA\Get(
     *     path="/api/languages",
     *     summary="Muestra todos los idiomas paginados",
     *     tags={"Languages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de idiomas",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/LanguageResource")
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
        public function index() {
            return LanguageResource::collection(Language::paginate(100));
        }

       /**
     * @OA\Post(
     *     path="/api/languages",
     *     summary="Crea un nuevo idioma",
     *     tags={"Languages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreLanguageRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Idioma creado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/LanguageResource")
     *     )
     * )
     */
        public function store(StoreLanguageRequest $request) {
            $language = Language::create($request->validated());
            return $this->sendResponse(new LanguageResource($language), 'Idioma creado con éxito', 201);
        }

         /**
     * @OA\Get(
     *     path="/api/languages/{id}",
     *     summary="Muestra un idioma",
     *     tags={"Languages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del idioma",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Idioma recuperado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/LanguageResource")
     *     )
     * )
     */
        public function show(Language $language) {
            return $this->sendResponse(new LanguageResource($language), 'Idioma mostrado con éxito', 200);
        }

           /**
     * @OA\Put(
     *     path="/api/languages/{id}",
     *     summary="Actualiza un idioma",
     *     tags={"Languages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del idioma",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateLanguageRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Idioma actualizado con éxito",
     *         @OA\JsonContent(ref="#/components/schemas/LanguageResource")
     *     )
     * )
     */
        public function update(UpdateLanguageRequest $request, Language $language) {
            $language->update($request->validated());
            return $this->sendResponse(new LanguageResource($language), 'Idioma actualizado con éxito', 200);
        }

       /**
     * @OA\Delete(
     *     path="/api/languages/{id}",
     *     summary="Elimina un idioma",
     *     tags={"Languages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del idioma",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Idioma eliminado con éxito"
     *     )
     * )
     */
        public function destroy(Language $language) {
            $language->teleoperators()->detach();
            $language->delete();
            return $this->sendResponse(null, 'Idioma eliminado con éxito', 204);
        }
    }
?>