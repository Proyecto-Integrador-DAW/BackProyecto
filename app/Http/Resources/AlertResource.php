<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="AlertResource",
 *     description="Esquema del recurso Alerta",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador de la alerta"),
 *     @OA\Property(property="alert", ref="#/components/schemas/AlertSubtypeCompactResource", description="Subtipo de alerta asociado"),
 *     @OA\Property(property="frequency", type="string", description="Frecuencia de la alerta"),
 *     @OA\Property(property="days_of_week", type="array", @OA\Items(type="string"), description="Días de la semana en los que se activa la alerta"),
 *     @OA\Property(property="zone", ref="#/components/schemas/ZoneResource", description="Zona geográfica asociada a la alerta")
 * )
 */
    class AlertResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'alert' => new AlertSubtypeCompactResource($this->alertSubtype),
                'frequency' => $this->frequency,
                'days_of_week' => $this->days_of_week,
                'zone' => new ZoneResource($this->zone)
            ];
        }
    }
?>