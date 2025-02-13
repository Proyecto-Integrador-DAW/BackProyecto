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
                'description' => $this->description,
                'type' => new AlertTypeResource($this->type),
                'start_day' => $this->start_day,
                'end_day' => $this->end_day,
                'periodicity' => $this->periodicity,
                'week_day' => $this->week_day,
            ];
        }
    }
?>