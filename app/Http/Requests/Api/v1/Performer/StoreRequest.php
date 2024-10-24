<?php

namespace App\Http\Requests\Api\v1\Performer;

use App\Facades\Performer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'projectId' => 'required|exists:projects,id',
            'performerId' => 'required|exists:users,id'
        ];
    }

    public function storePerformer(): JsonResponse
    {
        return Performer::store($this->validated());
    }
}
