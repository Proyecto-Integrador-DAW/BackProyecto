<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Zones;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patients>
 */
class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dni' => $this->faker->unique()->bothify('########?'),
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date(),
            'adress' => $this->faker->address,
            'phone_number' => $this->faker->unique()->numerify('#########'),
            'health_card' => $this->faker->unique()->bothify('#########'),
            'email' => $this->faker->unique()->safeEmail,
            'zone_id' => Zones::inRandomOrder()->first()->id ?? 1,
            'personal_situation' => $this->faker->sentence(6),
            'health_situation' => $this->faker->sentence(6),
            'housing_situation' => $this->faker->sentence(6),
            'economic_situation' => $this->faker->sentence(6),
            'autonomy' => $this->faker->randomElement(['independent', 'assisted', 'dependent']),
        ];
    }
}
