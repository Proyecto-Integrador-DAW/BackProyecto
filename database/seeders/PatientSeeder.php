<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Patients;
class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patients::create([
            'dni' => '12345678A',
            'name' => 'Joan Pérez',
            'birth_date' => Carbon::create('1998', '01', '15'),
            'address' => 'Carrer de la Pau, 12, Barcelona',
            'phone_number' => '612345678',
            'health_card' => 'HC123456',
            'email' => 'joan@example.com',
            'zone_id' => 1,
            'personal_situation' => 'Solter',
            'health_situation' => 'Estable',
            'housing_situation' => 'Propietat',
            'economic_situation' => 'Mitjana',
            'autonomy' => 'Alta',
        ]);
        Patients::factory()->count(10)->create();
    }
}
