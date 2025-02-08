<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CallTypes;

class CallTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $callTypes = [
            ['name' => 'Emergència social', 'category' => 'Atenció emergències'],
            ['name' => 'Emergència sanitària', 'category' => 'Atenció emergències'],
            ['name' => 'Crisi de soledat', 'category' => 'Atenció emergències'],
            ['name' => 'Alarma sense resposta', 'category' => 'Atenció emergències'],
            ['name' => 'Notificació d’absència', 'category' => 'Comunicacions no urgents'],
            ['name' => 'Petició d’informació', 'category' => 'Comunicacions no urgents'],
            ['name' => 'Seguiment d’alarma', 'category' => 'No planificades'],
            ['name' => 'Crida programada per avís', 'category' => 'Planificades'],
        ];
        
        foreach ($callTypes as $callType) {
            CallTypes::create($callType);
        }
        
        CallTypes::factory()->count(10)->create();
    }
}
