<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

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