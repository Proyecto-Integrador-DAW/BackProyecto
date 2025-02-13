<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

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