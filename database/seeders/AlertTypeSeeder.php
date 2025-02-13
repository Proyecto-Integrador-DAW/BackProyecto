<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AlertType;

class AlertTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alertTypes = [
            ['description' => 'Medicación', 'category_id' => 1],
            ['description' => 'Especial/alerta', 'category_id' => 1],
            ['description' => 'Después de emergencias', 'category_id' => 2],
            ['description' => 'Procesos de duelo', 'category_id' => 2],
            ['description' => 'Alta hospitalaria', 'category_id' => 2],
            ['description' => 'Suspensión temporal del servicio', 'category_id' => 3],
            ['description' => 'Retornos o fin de la ausencia', 'category_id' => 3],
        ];

        foreach ($alertTypes as $alertType) {
            AlertType::create($alertType);
        }
        AlertType::factory()->count(10)->create();
    }
}
