<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\AlertSubtypeResource;
    use App\Models\AlertSubtype;
    use Illuminate\Http\Request;

    class AlertSubtypeController extends BaseController {

           /**
     * @OA\Get(
     *     path="/api/subtypesAlerts",
     *     summary="Muestra todas las subtipos de alerta paginadas",
     *     tags={"AlertSubtypes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de subtipos de alerta",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/AlertSubtypeResource")
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
        public function index() {
            return AlertSubtypeResource::collection(AlertSubtype::paginate(100));
        }
    }
?>