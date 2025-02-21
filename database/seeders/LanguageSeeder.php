<?php

    namespace Database\Seeders;

    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use App\Models\Language;
    use Illuminate\Database\Seeder;

    class LanguageSeeder extends Seeder {

        /**
         * Run the database seeds.
         */
        public function run(): void {

            $languages = ['Español', 'Inglés', 'Francés', 'Alemán', 'Italiano', 'Portugués', 'Chino', 'Japonés'];

            foreach ($languages as $language) {
                Language::create(['name' => $language]);
            }
        }
    }
?>