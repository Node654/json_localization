<?php

namespace App\Services\Project;

use App\Http\Resources\Api\v1\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;

class ProjectService
{
    public function store(array $data): JsonResource
    {
        $data = Project::create([
            'name' => Arr::get($data, 'name'),
            'description' => Arr::get($data, 'description'),
            'source_language_id' => Arr::get($data, 'languages.source'),
            'target_language_ids' => Arr::get($data, 'languages.target'),
            'use_machine_translate' => Arr::get($data, 'settings.useMachineTranslate'),
        ]);

        return new ProjectResource($data);
    }
}
