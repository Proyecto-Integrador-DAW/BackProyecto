<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="AlertTypeResource",
 *     description="Esquema del recurso Tipo de Alerta",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del tipo de alerta"),
 *     @OA\Property(property="name", type="string", description="Nombre del tipo de alerta")
 * )
 */
    class AlertTypeResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'name' => $this->name
            ];
        }
    }
?>