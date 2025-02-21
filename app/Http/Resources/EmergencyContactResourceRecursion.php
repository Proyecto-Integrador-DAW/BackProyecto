<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="EmergencyContactResourceRecursion",
 *     description="Esquema del recurso Contacto de Emergencia en Recursión",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del contacto de emergencia"),
 *     @OA\Property(property="name", type="string", description="Nombre del contacto de emergencia"),
 *     @OA\Property(property="phone_number", type="string", description="Número de teléfono del contacto de emergencia")
 * )
 */
    class EmergencyContactResourceRecursion extends JsonResource {

        /**
         * Transform the resource into an array.
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'phone_number' => $this->phone_number,
            ];
        }
    }
?>