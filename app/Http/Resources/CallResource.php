<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

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