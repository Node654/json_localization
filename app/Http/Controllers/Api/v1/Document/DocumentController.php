<?php

namespace App\Http\Controllers\Api\v1\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Document\AddDocumentsRequest;
use App\Http\Requests\Api\v1\Document\GetDocumentsRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentController extends Controller
{
    public function add(AddDocumentsRequest $request): JsonResponse
    {
        return $request->addDocuments();
    }

    public function list(GetDocumentsRequest $request): JsonResource
    {
        return $request->getDocuments();
    }
}
