<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WarningTypes;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warnings>
 */
class WarningsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(6),
            'type_id' => WarningTypes::inRandomOrder()->first()->id ?? 1,
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'periodicity' => $this->faker->randomElement(['punctual', 'periodic']),
            'week_day' => $this->faker->optional()->randomElement(['Monday','Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday']),
        ];
    }
}
