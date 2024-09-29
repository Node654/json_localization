<?php

namespace Database\Seeders\Language;

use App\Models\Language;

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::factory(5)->create();
    }
}
