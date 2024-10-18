<?php

namespace App\Services\Project;

use App\DTO\ProjectDTO;
use App\Http\Resources\Api\v1\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ProjectService
{
    private Project $project;

    public function store(array $data): JsonResource
    {
        $projectDto = new ProjectDTO(
            name: Arr::get($data, 'name'),
            userId: authUserId(),
            description: Arr::get($data, 'description'),
            sourceLanguageId: Arr::get($data, 'languages.source'),
            targetLanguagesIds: Arr::get($data, 'languages.target'),
            useMachineTranslate: Arr::get($data, 'settings.useMachineTranslate'),
        );

        $data = Project::create([
            'name' => $projectDto->name,
            'user_id' => $projectDto->userId,
            'description' => $projectDto->description,
            'source_language_id' => $projectDto->sourceLanguageId,
            'target_language_ids' => $projectDto->targetLanguagesIds,
            'use_machine_translate' => $projectDto->useMachineTranslate,
        ]);

        return new ProjectResource($data);
    }

    public function setProject(Project $project): ProjectService
    {
        $this->project = $project;

        return $this;
    }

    public function update(array $data): JsonResource
    {
        $projectDto = new ProjectDTO(
            name: Arr::get($data, 'name') ?? $this->project->name,
            description: Arr::get($data, 'description') ?? $this->project->description,
            sourceLanguageId: Arr::get($data, 'languages.source') ?? $this->project->source_language_id,
            targetLanguagesIds: Arr::get($data, 'languages.target') ?? $this->project->target_language_ids,
            useMachineTranslate: Arr::get($data, 'settings.useMachineTranslate') ?? $this->project->use_machine_translate,
        );

        $mappedData = $projectDto->mapProjectData($data);

        $this->project->update($mappedData);

        return new ProjectResource($this->project);
    }
}
