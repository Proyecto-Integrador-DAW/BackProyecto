<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Alert;
    use App\Models\AlertType;
    use App\Models\AlertSubtype;
    use App\Models\Zone;

    class AlertSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            $avisos = AlertType::create(['name' => 'Avisos']);
            $seguiment = AlertType::create(['name' => 'Seguiment segons protocols']);
            $agendes = AlertType::create(['name' => 'Agendes d’absència domiciliària i retorn']);
    
            $avisos->subtypes()->createMany([
                ['name' => 'Medicación'],
                ['name' => 'Especiales o por alerta'],
            ]);
    
            $seguiment->subtypes()->createMany([
                ['name' => 'Después de emergencias'],
                ['name' => 'Proceso de duelo'],
                ['name' => 'Alta hospitalaria'],
            ]);
    
            $agendes->subtypes()->createMany([
                ['name' => 'Suspensión temporal del servicio'],
                ['name' => 'Retornos o fin de la ausencia'],
            ]);

            Alert::factory()->count(50)->create();
        }
    }
?>