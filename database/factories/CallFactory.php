<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\Teleoperator;
    use App\Models\Patient;
    use App\Models\Alert;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Call>
     */
    class CallFactory extends Factory {

        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array {

            $callType = $this->faker->randomElement(['Entrante', 'Saliente']);

            $type = $callType === 'entrante' 
                ? $this->faker->randomElement([
                    'Emergencia social', 
                    'Emergencia sanitaria', 
                    'Crisis soledad', 
                    'Alarma sin respuesta', 
                    'Comunicacion no urgente',
                    'Notificar absencia', 
                    'Modificar datos personales', 
                    'Llamada accidental', 
                    'Peticion informacion',
                    'Sugerencia queja reclamacion', 
                    'Llamada social', 
                    'Registrar cita medica',
                    'Otros'
                ])
                : $this->faker->randomElement(['Planificada', 'No planificada']);

            $alert = null;
            if ($type === 'Planificada') {
                $alert = Alert::inRandomOrder()->first()?->id;
            } elseif ($type === 'No planificada') {
                $alert = $this->faker->optional(0.5)->randomElement(Alert::pluck('id')->toArray());
            }

            return [
                'teleoperator_id' => Teleoperator::inRandomOrder()->first()->id,
                'patient_id' => Patient::inRandomOrder()->first()->id,
                'call_type' => $callType,
                'type' => $type,
                'call_time' => $this->faker->dateTimeThisYear(),
                'description' => $this->faker->optional(0.75)->text(),
                'alert_id' => $alert
            ];
        }
    }
?>