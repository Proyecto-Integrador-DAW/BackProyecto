<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\Patient;
    use App\Models\EmergencyContact;
    
    class PatientContactsSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            $patients = Patient::all();
            
            foreach ($patients as $patient) {
                $randomContact = EmergencyContact::inRandomOrder()->first()->id;
                $patient->emergencyContacts()->attach(['emergency_contacts' => $randomContact]);
            }
        }
    }
?>