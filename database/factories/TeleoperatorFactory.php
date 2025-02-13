<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\Zone;
    use Illuminate\Support\Facades\Hash;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teleoperators>
     */
    class TeleoperatorFactory extends Factory {

        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array {

            $prefixes = ['+34', '+1', '+44', '+49', '+33', '+39', '+351', '+81', '+86']; 

            return [
                'name' => $this->faker->unique()->name,
                'email' => $this->faker->unique()->safeEmail,
                'prefix' => $this->faker->randomElement($prefixes),
                'phone_number' => $this->faker->phoneNumber,
                'zone_id' => Zone::inRandomOrder()->first()->id ?? 1,
                'hiring_date' => $this->faker->date(),
                'code' => $this->faker->unique()->bothify('OP####'),
                'password' => Hash::make('password'),
                'firing_date' => $this->faker->optional()->date(),
            ];
        }
    }
?>