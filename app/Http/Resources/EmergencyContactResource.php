<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

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