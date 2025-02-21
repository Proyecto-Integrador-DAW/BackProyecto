<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="CallResource",
 *     description="Esquema del recurso Llamada",
 *     
 *     @OA\Property(property="id", type="integer", description="Identificador de la llamada"),
 *     @OA\Property(property="teleoperator", ref="#/components/schemas/TeleoperatorResource", description="Teleoperador que realizó la llamada"),
 *     @OA\Property(property="patient", ref="#/components/schemas/PatientResource", description="Paciente asociado a la llamada"),
 *     @OA\Property(property="call_type", type="string", enum={"Entrante", "Saliente"}, description="Tipo de llamada"),
 *     @OA\Property(property="type", type="string", description="Tipo específico de la llamada"),
 *     @OA\Property(property="call_time", type="string", format="date-time", description="Fecha y hora de la llamada"),
 *     @OA\Property(property="title", type="string", nullable=true, description="Título de la llamada"),
 *     @OA\Property(property="description", type="string", nullable=true, description="Descripción de la llamada"),
 *     @OA\Property(property="alert", ref="#/components/schemas/CallTitleResource", nullable=true, description="Alerta asociada a la llamada")
 * )
 */
    class CallResource extends JsonResource {

        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array {
            return [
                'id' => $this->id,
                'teleoperator' => new TeleoperatorResource($this->teleoperator),
                'patient' => new PatientResource($this->patient),
                'call_type' => $this->call_type,
                'type' => $this->type,
                'call_time' => $this->call_time,
                'title' => $this->title,
                'description' => $this->description,
                'alert' => new CallTitleResource($this->alert)
            ];
        }
    }
?>