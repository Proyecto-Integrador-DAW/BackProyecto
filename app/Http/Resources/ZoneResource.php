<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="ZoneResource",
 *     description="Esquema del recurso Zona",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador de la zona"),
 *     @OA\Property(property="city", type="string", description="Nombre de la ciudad"),
 *     @OA\Property(property="zone", type="string", description="Nombre de la zona dentro de la ciudad")
 * )
 */
    class ZoneResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'city' => $this->city,
                'zone' => $this->zone,
            ];
        }
    }
?>