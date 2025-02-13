<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\WarningTypes;

class WarningTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warningTypes = [
            ['description' => 'Medicación', 'category_id' => 1],
            ['description' => 'Especial/alerta', 'category_id' => 1],
            ['description' => 'Después de emergencias', 'category_id' => 2],
            ['description' => 'Procesos de duelo', 'category_id' => 2],
            ['description' => 'Alta hospitalaria', 'category_id' => 2],
            ['description' => 'Suspensión temporal del servicio', 'category_id' => 3],
            ['description' => 'Retornos o fin de la ausencia', 'category_id' => 3],
        ];

        foreach ($warningTypes as $warningType) {
            WarningTypes::create($warningType);
        }
        WarningTypes::factory()->count(10)->create();
    }
}
