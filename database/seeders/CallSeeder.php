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
            Call::factory()->count(300)->create();
        }
    }
?>