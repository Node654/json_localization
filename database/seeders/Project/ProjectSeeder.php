<?php

namespace Database\Seeders\Project;

use App\Models\Document;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory(10)->has(Document::factory(3))->create();
    }
}
