<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AlertCategory;

class AlertCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warningCategories = [
            ['description' => 'Avisos'],
            ['description' => 'Seguimiento según protocolo'],
            ['description' => 'Agendas de ausencia domiciliaria y retorno'],
        ];

        foreach ($warningCategories as $warningCategory) {
            AlertCategory::create($warningCategory);
        }
        AlertCategory::factory()->count(10)->create();
    }
}
