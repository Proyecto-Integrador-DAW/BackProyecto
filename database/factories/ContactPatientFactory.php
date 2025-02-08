<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patients;
use App\Models\Contacts;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactPatient>
 */
class ContactPatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patients::inRandomOrder()->first()->id ?? 1,
            'contact_id' => Contacts::inRandomOrder()->first()->id ?? 1,
            'relationship' => $this->faker->randomElement(['Father', 'Mother', 'Sibling', 'Friend', 'Caregiver']),
        ];

    }
}
