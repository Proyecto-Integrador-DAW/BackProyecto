<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Calls;

class CallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Calls::create([
            'date_time' => '2023-07-15 14:23:45',
            'operator_id' => 1,
            'patient_id' => 1,
            'description' => 'Consulta mèdica',
            'call_type' => 1,
            'type' => 'entrante',
            'warning_id' => null
        ]);
        Calls::factory()->count(10)->create();
    }
}
