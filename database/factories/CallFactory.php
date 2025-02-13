<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Call;
use App\Models\Teleoperator;
use App\Models\Patient;
use App\Models\CallType;
use App\Models\Alert;
use Carbon\Carbon;

class CallFactory extends Factory
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
            'operator_id' => Teleoperator::inRandomOrder()->first()->id ?? 1,
            'patient_id' => Patient::inRandomOrder()->first()->id ?? 1,
            'description' => $this->faker->sentence(10),
            'call_type' => CallType::inRandomOrder()->first()->id ?? 1,
            'type' => $this->faker->randomElement(['emergency', 'routine', 'follow-up']),
            'alert_id' => Alert::inRandomOrder()->first()->id ?? null,
        ];
    }
}
