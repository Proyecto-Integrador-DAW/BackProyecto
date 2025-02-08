<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Zones;

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
            Zones::create($zone);
        }
        Zones::factory()->count(10)->create();
    }
}
