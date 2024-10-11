<?php

namespace App\Http\Requests\Api\v1\Document;

use App\Facades\Document;
use Illuminate\Foundation\Http\FormRequest;

class GetDocumentsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'projectId' => 'required|exists:projects,id'
        ];
    }

    public function getDocuments()
    {
        return Document::setProject($this->validated()['projectId'])->list();
    }
}
