<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Teleoperator;

class TeleoperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teleoperator::create([
            'name' => 'Marc Torres',
            'email' => 'marc.torres@example.com',
            'phone_number' => '612345678',
            'zone_id' => 1,
            'mother_tongue' => 'Catalan',
            'hiring_date' => Carbon::create('2020', '01', '15'),
            'code' => 'T1001',
            'password' => bcrypt('password123'), 
            'firing_date' => null,  
        ]);
        Teleoperator::factory()->count(10)->create();
    }
}
