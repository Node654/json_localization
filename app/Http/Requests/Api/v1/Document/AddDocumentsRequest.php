<?php

namespace App\Http\Requests\Api\v1\Document;

use App\Facades\Document;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class AddDocumentsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'projectId' => 'required|exists:projects,id',
            'documents' => 'required|array',
            'documents.*.name' => 'required|string',
            'documents.*.data' => 'required|array',
            'documents.*.data.*.key' => 'required|string|unique:documents,data->key',
            'documents.*.data.*.value' => 'required|string',
        ];
    }

    public function addDocuments(): JsonResponse
    {
        return Document::setProject($this->input('projectId'))->addDocuments($this->input('documents'));
    }
}
