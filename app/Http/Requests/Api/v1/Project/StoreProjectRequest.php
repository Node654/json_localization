<?php

namespace App\Http\Requests\Api\v1\Project;

use App\Facades\Project;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'languages' => 'required', 'array', 'required_array_keys:source,target',
            'languages.source' => 'required|int|exists:languages,id',
            'languages.target.*' => 'required|int',
            'settings' => 'required', 'required_array_keys:useMachineTranslate',
            'useMachineTranslate' => 'bool',
        ];
    }

    public function createProject()
    {
        return Project::store($this->validated());
    }
}
