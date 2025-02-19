<?php

    namespace Database\Seeders;


    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Carbon;
    use App\Models\Teleoperator;

    class TeleoperatorSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            Teleoperator::create([
                'name' => 'Marc Torres',
                'email' => 'marc.torres@example.com',
                'prefix' => '+34',
                'phone_number' => '612345678',
                'zone_id' => 1,
                'hiring_date' => Carbon::create('2020', '01', '15'),
                'code' => null,
                'password' => '12345678', 
                'firing_date' => null
            ]);

            Teleoperator::factory()->count(19)->create();
        }
    }
?>