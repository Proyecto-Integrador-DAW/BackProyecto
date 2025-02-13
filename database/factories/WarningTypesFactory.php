<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WarningCategories;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarningTypes>
 */
class WarningTypesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(4),
            'category_id' => WarningCategories::inRandomOrder()->first()->id ?? 1,
        ];
    }
}
