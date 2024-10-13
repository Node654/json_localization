<?php

namespace App\Http\Requests\Api\v1\Document;

use Illuminate\Foundation\Http\FormRequest;

class ImportTranslationsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lang' => 'required|exists:languages,id',
            'data' => 'required|array',
            'data.*.key' => 'required|string|unique:documents,data->key',
            'data.*.value' => 'required|string',
        ];
    }
}
