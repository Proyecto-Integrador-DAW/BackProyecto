<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\AlertSubtype;
    use App\Models\Zone;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alert>
     */
    class AlertFactory extends Factory {

        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array {

            $subtype = AlertSubtype::inRandomOrder()->first();

            $days = [1, 2, 3, 4, 5, 6, 7];
            $frequency = $this->faker->randomElement(['Puntual', 'Diaria', 'Varios días', 'Semanal', 'Mensual']);
            $daysOfWeek = match ($frequency) {
                'Varios días' => json_encode($this->faker->randomElements($days, rand(2, 7))),
                default => null,
            };

            return [
                'alert_subtype_id' => $subtype->id,
                'title' => $subtype->alertType->name,
                'description' => $subtype->name,
                'frequency' => $frequency,
                'days_of_week' => $daysOfWeek,
                'zone_id' => Zone::inRandomOrder()->first()->id
            ];
        }
    }
?>