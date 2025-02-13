<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'dni' => '12345678A',
            'name' => 'Paco Pérez',
            'address' => '123 Main St',
            'phone_number' => 123456789,
            'email' => 'pacope@example.com',
        ]);
        Contact::factory()->count(10)->create();
    }
}
