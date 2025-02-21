<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="LanguageResource",
 *     description="Esquema del recurso de Idioma",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del idioma"),
 *     @OA\Property(property="name", type="string", description="Nombre del idioma")
 * )
 */
    class LanguageResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'name' => $this->name,
            ];
        }
    }
?>