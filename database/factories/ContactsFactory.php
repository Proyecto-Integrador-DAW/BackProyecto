<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacts>
 */
class ContactsFactory extends Factory
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
            'adress' => $this->faker->address,
            'phone_number' => $this->faker->unique()->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
