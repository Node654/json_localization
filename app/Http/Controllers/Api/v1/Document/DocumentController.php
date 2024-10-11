<?php

namespace App\Http\Controllers\Api\v1\Document;

use App\Facades\Document as DocumentFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Document\AddDocumentsRequest;
use App\Http\Requests\Api\v1\Document\GetDocumentsRequest;

use App\Models\Project;
use App\Models\Document;
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

    public function destroy(Document $document): JsonResponse
    {
        return DocumentFacade::destroy($document);
    }
}
