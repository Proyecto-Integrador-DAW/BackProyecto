<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contacts;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contacts::create([
            'dni' => '12345678A',
            'name' => 'Paco Pérez',
            'adress' => '123 Main St',
            'phone_number' => 123456789,
            'email' => 'pacope@example.com',
        ]);
        Contacts::factory()->count(10)->create();
    }
}
