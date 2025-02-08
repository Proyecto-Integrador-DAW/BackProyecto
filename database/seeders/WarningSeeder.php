<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Warnings;

class WarningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warnings::create([
            'description' => 'Pastillas para dormir',
            'type' => 1,
            'start_date' => Carbon::now()->format('Y-m-d'),
            'end_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'periodicity' => 'punctual',
            'week_day' => null,
        ]);
        Warnings::factory()->count(10)->create();
    }
}
