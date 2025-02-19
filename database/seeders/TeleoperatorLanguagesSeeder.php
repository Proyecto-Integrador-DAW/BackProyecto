<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Teleoperator;

    class TeleoperatorLanguagesSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            $teleoperators = Teleoperator::all();

            foreach ($teleoperators as $teleoperator) {
                $teleoperator->languages()->attach(['languages' => 1]);
            }
        }
    }
?>