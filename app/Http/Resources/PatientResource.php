<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
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
            'personal_situation' => $this->personal_situation,
            'health_situation' => $this->health_situation,
            'housing_situation' => $this->housing_situation,
            'economic_situation' => $this->economic_situation,
            'autonomy' => $this->autonomy,
        ];
    }
}
