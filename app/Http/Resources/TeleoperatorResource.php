<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="TeleoperatorResource",
 *     description="Esquema del recurso Teleoperador",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del teleoperador"),
 *     @OA\Property(property="name", type="string", description="Nombre del teleoperador"),
 *     @OA\Property(property="email", type="string", format="email", description="Correo electrónico del teleoperador"),
 *     @OA\Property(property="prefix", type="string", description="Prefijo telefónico"),
 *     @OA\Property(property="phone_number", type="string", description="Número de teléfono del teleoperador"),
 *     @OA\Property(property="zone", ref="#/components/schemas/ZoneResource", description="Zona del teleoperador"),
 *     @OA\Property(property="languages", type="array", @OA\Items(type="string"), description="Idiomas hablados por el teleoperador"),
 *     @OA\Property(property="hiring_date", type="string", format="date", description="Fecha de contratación"),
 *     @OA\Property(property="code", type="string", description="Código de identificación del teleoperador"),
 *     @OA\Property(property="firing_date", type="string", format="date", nullable=true, description="Fecha de despido (puede ser nula si sigue activo)")
 * )
 */
    class TeleoperatorResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'prefix' => $this->prefix,
                'phone_number' => $this->phone_number,
                'zone' => new ZoneResource($this->zone),
                'languages' => $this->languages->pluck('name'),
                'hiring_date' => $this->hiring_date,
                'code' => $this->code,
                'firing_date' => $this->firing_date,
            ];    
        }
    }
?>