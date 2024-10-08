<?php

namespace App\Http\Controllers\Api\v1\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Document\AddDocumentsRequest;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    public function addDocuments(AddDocumentsRequest $request): JsonResponse
    {
        return $request->addDocuments();
    }
}
