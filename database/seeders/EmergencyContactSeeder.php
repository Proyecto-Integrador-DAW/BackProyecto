<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\EmergencyContact;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Support\Facades\DB;

    class EmergencyContactSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            EmergencyContact::create([
                'name' => 'Ángel',
                'phone_number' => '666 66 66 66',
                'relationship' => 'Nieto',
                'created_by' => 1
            ]);

            EmergencyContact::factory()->count(10)->create();
        }
    }
?>