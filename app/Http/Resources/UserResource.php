<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="UserResource",
 *     description="Esquema del recurso Usuario",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del usuario"),
 *     @OA\Property(property="name", type="string", description="Nombre del usuario"),
 *     @OA\Property(property="email", type="string", format="email", description="Correo electrónico del usuario"),
 *     @OA\Property(property="code", type="string", description="Código identificador del usuario")
 * )
 */
    class UserResource extends JsonResource {

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
                'code' => $this->code
            ];
        }
    }
?>