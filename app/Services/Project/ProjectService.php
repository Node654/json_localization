<?php

namespace App\Services\Project;

use App\DTO\ProjectDTO;
use App\Http\Resources\Api\v1\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;

class ProjectService
{
    public function store(array $data): JsonResource
    {
        $projectDto = new ProjectDTO(
            name: Arr::get($data, 'name'),
            description: Arr::get($data, 'description'),
            sourceLanguageId:Arr::get($data, 'languages.source'),
            targetLanguagesIds:Arr::get($data, 'languages.target'),
            useMachineTranslate:Arr::get($data, 'settings.useMachineTranslate'),
        );
        $data = Project::create([
            'name' => $projectDto->name,
            'description' => $projectDto->description,
            'source_language_id' => $projectDto->sourceLanguageId,
            'target_language_ids' => $projectDto->targetLanguagesIds,
            'use_machine_translate' => $projectDto->useMachineTranslate,
        ]);

        return new ProjectResource($data);
    }
}
