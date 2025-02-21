<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="PatientResource",
 *     description="Esquema del recurso Paciente",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador del paciente"),
 *     @OA\Property(property="dni", type="string", description="DNI del paciente"),
 *     @OA\Property(property="name", type="string", description="Nombre del paciente"),
 *     @OA\Property(property="birth_date", type="string", format="date", description="Fecha de nacimiento del paciente"),
 *     @OA\Property(property="address", type="string", description="Dirección del paciente"),
 *     @OA\Property(property="phone_number", type="string", description="Número de teléfono del paciente"),
 *     @OA\Property(property="health_card", type="string", description="Número de tarjeta sanitaria del paciente"),
 *     @OA\Property(property="email", type="string", format="email", description="Correo electrónico del paciente"),
 *     @OA\Property(property="zone", ref="#/components/schemas/ZoneResource", description="Zona del paciente"),
 *     @OA\Property(property="associated_teleoperator_id", ref="#/components/schemas/TeleoperatorResource", description="Teleoperador del paciente"),
 *     @OA\Property(property="personal_situation", type="string", description="Situación personal del paciente"),
 *     @OA\Property(property="health_situation", type="string", description="Situación de salud del paciente"),
 *     @OA\Property(property="housing_situation", type="string", description="Situación de vivienda del paciente"),
 *     @OA\Property(property="economic_situation", type="string", description="Situación económica del paciente"),
 *     @OA\Property(property="autonomy", type="string", description="Nivel de autonomía del paciente"),
 *     @OA\Property(
 *         property="emergency_contacts",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/EmergencyContactResourceRecursion"),
 *         description="Contactos de emergencia asociados al paciente"
 *     )
 * )
 */
    class PatientResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'dni' => $this->dni,
                'name' => $this->name,
                'birth_date' => $this->birth_date,
                'address' => $this->address,
                'phone_number' => $this->phone_number,
                'health_card' => $this->health_card,
                'email' => $this->email,
                'zone' => new ZoneResource($this->zone),
                'associated_teleoperator_id' => new TeleoperatorResource($this->teleoperator),
                'personal_situation' => $this->personal_situation,
                'health_situation' => $this->health_situation,
                'housing_situation' => $this->housing_situation,
                'economic_situation' => $this->economic_situation,
                'autonomy' => $this->autonomy,
                'emergency_contacts' => EmergencyContactResourceRecursion::collection($this->emergencyContacts)
            ];
        }
    }
?>