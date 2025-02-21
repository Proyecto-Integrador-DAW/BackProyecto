<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="AlertSubtypeCompactResource",
 *     description="Esquema del recurso Subtipo de Alerta",
 *     
 *     @OA\Property(property="name", type="string", description="Nombre del tipo de alerta"),
 *     @OA\Property(property="description", type="string", description="Descripción del subtipo de alerta")
 * )
 */
    class AlertSubtypeCompactResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'name' => $this->alertType->name,
                'description' => $this->name
            ];
        }
    }
?>