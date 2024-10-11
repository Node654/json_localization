<?php

namespace App\Http\Requests\Api\v1\Project;

use App\Facades\Project as ProjectService;
use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'languages' => 'nullable', 'array', 'nullable_array_keys:source,target',
            'languages.source' => 'nullable|int|exists:languages,id',
            'languages.target.*' => 'nullable|int',
            'settings' => 'nullable', 'nullable_array_keys:useMachineTranslate',
            'useMachineTranslate' => 'nullable|bool',
            'progress' => 'nullable|int|max:100',
        ];
    }

    public function update(Project $project): JsonResource
    {
        return ProjectService::setProject($project)->update($this->validated());
    }
}
