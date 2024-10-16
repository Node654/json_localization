<?php

namespace App\Http\Requests\Api\v1\Project;

use App\Facades\Project;
use Illuminate\Contracts\Validation\Validator;
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
            'languages.target.*' => 'required|int|exists:languages,id',
            'settings' => 'required', 'required_array_keys:useMachineTranslate',
            'useMachineTranslate' => 'nullable|bool',
            'progress' => 'nullable|int|max:100',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            if (in_array($this->input('languages.source'), $this->input('languages.target')))
            {
                /**
                 * @var Validator $validator
                 */
                $validator->errors()->add('languages.target', 'The language in the source must not match the languages in the target.');
            }
        });
    }

    public function createProject()
    {
        return Project::store($this->validated());
    }
}
