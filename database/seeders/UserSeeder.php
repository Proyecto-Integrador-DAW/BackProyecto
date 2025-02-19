<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '12345678',
                'role' => 'administrador'
            ]);

            User::create([
                'name' => 'Noemí',
                'email' => 'noemi@coordinadora.com',
                'password' => '12345678',
                'role' => 'coordinador',
                'code' => '0'
            ]);
        }
    }
?>