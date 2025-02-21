<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['city' => 'Alcoi', 'zone' => 'Santa Rosa'],
            ['city' => 'Alcoi', 'zone' => 'El camí'],
            ['city' => 'Alcoi', 'zone' => 'Zona Norte'],
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }
        Zone::factory()->count(10)->create();
    }
}
