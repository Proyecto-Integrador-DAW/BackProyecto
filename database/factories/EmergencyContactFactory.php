<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\User;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacts>
     */
    class EmergencyContactFactory extends Factory {

        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array {

            $relations = ['Hermano', 'Hermana', 'Hija', 'Hijo', 'Nieto', 'Nieta', 'Primo', 'Prima', 'Amigo', 'Amiga'];

            return [
                'name' => $this->faker->name(),
                'phone_number' => $this->faker->phoneNumber(),
                'relationship' => $this->faker->randomElement($relations),
                'created_by' => 1
            ];
        }
    }
?>