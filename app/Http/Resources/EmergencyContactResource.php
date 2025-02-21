<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="EmergencyContactResource",
 *     description="Esquema del recurso Contacto de Emergencia",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del contacto de emergencia"),
 *     @OA\Property(property="name", type="string", description="Nombre del contacto de emergencia"),
 *     @OA\Property(property="phone_number", type="string", description="Número de teléfono del contacto de emergencia"),
 *     @OA\Property(
 *         property="patients",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/PatientResourceRecursion"),
 *         description="Lista de pacientes asociados a este contacto de emergencia"
 *     )
 * )
 */
    class EmergencyContactResource extends JsonResource {

        /**
         * Transform the resource into an array.
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'phone_number' => $this->phone_number,
                'patients' => PatientResourceRecursion::collection($this->patients)
            ];
        }
    }
?>