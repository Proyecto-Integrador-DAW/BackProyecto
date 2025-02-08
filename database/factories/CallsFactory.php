<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Calls;
use App\Models\Teleoperators;
use App\Models\Patients;
use App\Models\CallTypes;
use App\Models\Warnings;
use Carbon\Carbon;

class CallsFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_time' => Carbon::now()->subDays(rand(1, 30)),
            'operator_id' => Teleoperators::inRandomOrder()->first()->id ?? 1,
            'patient_id' => Patients::inRandomOrder()->first()->id ?? 1,
            'description' => $this->faker->sentence(10),
            'call_type' => CallTypes::inRandomOrder()->first()->id ?? 1,
            'type' => $this->faker->randomElement(['emergency', 'routine', 'follow-up']),
            'warning_id' => Warnings::inRandomOrder()->first()->id ?? null,
        ];
    }
}
