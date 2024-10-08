<?php

namespace Database\Seeders\Project;

use App\Models\Project;
use Database\Factories\DocumentFactory;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory(10)->has(new DocumentFactory())->create();
    }
}
