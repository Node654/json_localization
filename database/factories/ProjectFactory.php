<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sourceLanguageId = Language::inRandomOrder()->first()->id;
        return [
            'name' => fake()->name,
            'description' => fake()->text(50),
            'source_language_id' => $sourceLanguageId,
            'target_language_ids' => Language::query()->whereNot('id', $sourceLanguageId)->inRandomOrder()->limit(3)->get()->map(function ($el) {
                return $el->id;
            })->toArray(),
            'use_machine_translate' => fake()->boolean()
        ];
    }
}

