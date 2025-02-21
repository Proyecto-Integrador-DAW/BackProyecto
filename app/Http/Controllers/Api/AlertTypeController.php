<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\AlertTypeResource;
    use App\Models\AlertType;
    use Illuminate\Http\Request;

    class AlertTypeController {

       
    /**
     * @OA\Get(
     *     path="/api/typesAlerts",
     *     summary="Muestra todos los tipos de alertas paginados",
     *     tags={"AlertTypes"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tipos de alertas",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/AlertTypeResource")
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
        public function index() {
            return AlertTypeResource::collection(AlertType::paginate(100));
        }
    }
