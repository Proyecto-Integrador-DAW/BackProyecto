<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="CallTitleResource",
 *     description="Esquema del recurso Título de Llamada",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del título de la llamada"),
 *     @OA\Property(property="title", type="string", description="Título de la llamada")
 * )
 */
    class CallTitleResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'title' => $this->title
            ];
        }
    }
?>