<?php

namespace App\Http\Requests\Api\v1\Document;

use Illuminate\Foundation\Http\FormRequest;

class GetDocumentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'locale' => 'required|string',
        ];
    }
}
