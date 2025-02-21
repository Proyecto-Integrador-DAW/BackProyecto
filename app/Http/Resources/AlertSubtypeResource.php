<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="AlertSubtypeResource",
 *     description="Esquema del recurso Subtipo de Alerta",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del subtipo de alerta"),
 *     @OA\Property(property="alert_type", type="integer", description="ID del tipo de alerta asociado"),
 *     @OA\Property(property="name", type="string", description="Nombre del subtipo de alerta")
 * )
 */
    class AlertSubtypeResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                // 'alert_type' => new AlertTypeResource($this->alertType),
                'alert_type' => $this->alert_type_id,
                'name' => $this->name,
            ];
        }
    }
?>