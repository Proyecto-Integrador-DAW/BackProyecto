<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Zones;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teleoperators>
 */
class TeleoperatorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'zone_id' => Zones::inRandomOrder()->first()->id ?? 1,
            'mother_tongue' => $this->faker->languageCode,
            'hiring_date' => $this->faker->date(),
            'code' => $this->faker->unique()->bothify('OP####'),
            'password' => Hash::make('password'),
            'firing_date' => $this->faker->optional()->date(),
        ];
    }
}
