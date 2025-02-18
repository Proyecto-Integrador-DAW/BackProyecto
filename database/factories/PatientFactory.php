<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\Zone;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patients>
     */
    class PatientFactory extends Factory {

        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array {
            return [
                'dni' => $this->faker->unique()->bothify('########?'),
                'name' => $this->faker->name,
                'birth_date' => $this->faker->date(),
                'address' => $this->faker->address,
                'phone_number' => $this->faker->unique()->numerify('#########'),
                'health_card' => $this->faker->unique()->bothify('##########'),
                'email' => $this->faker->unique()->safeEmail,
                'zone_id' => Zone::inRandomOrder()->first()->id,
                'personal_situation' => $this->faker->sentence(2),
                'health_situation' => $this->faker->sentence(2),
                'housing_situation' => $this->faker->sentence(2),
                'economic_situation' => $this->faker->sentence(2),
                'autonomy' => $this->faker->randomElement(['Independiente', 'Asistido', 'Dependiente']),
            ];
        }
    }
?>