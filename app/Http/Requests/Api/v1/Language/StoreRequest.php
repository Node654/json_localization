<?php

namespace App\Http\Requests\Api\v1\Language;

use App\Facades\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50', 'string', 'unique:languages,name'],
            'locale' => ['required', 'max:50', 'string', 'unique:languages,locale'],
        ];
    }

    public function addLanguage(): JsonResponse
    {
        return Language::store($this->validated());
    }
}
