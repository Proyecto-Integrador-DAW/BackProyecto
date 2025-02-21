<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Call;

    class CallSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            Call::factory()->count(50)->create([
                'title' => 'Recordatorio tomar pastillas'
            ]);

            Call::factory()->count(50)->create([
                'title' => 'Revisión alta hospitalaria'
            ]);

            Call::factory()->count(50)->create([
                'title' => 'Seguimiento tratamiento médico'
            ]);

            Call::factory()->count(50)->create([
                'title' => 'Consulta resultados de laboratorio'
            ]);

            Call::factory()->count(50)->create([
                'title' => 'Recordatorio cita con especialista'
            ]);

            Call::factory()->count(50)->create([
                'title' => 'Control de presión arterial'
            ]);
        }
    }
?>