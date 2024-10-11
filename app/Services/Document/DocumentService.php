<?php

namespace App\Services\Document;

use App\Http\Resources\Api\v1\Document\DocumentResource;
use App\Http\Resources\Api\v1\Document\MinifiedDocumentResource;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class DocumentService
{
    private Project $project;

    public function addDocuments(array $documents): JsonResponse
    {
        $this->project->documents()->createMany($documents);

        return responseCreated();
    }

    public function setProject(Project|int $project): DocumentService
    {
        $this->project = $project instanceof Project ? $project : Project::find($project);

        return $this;
    }

    public function list(): JsonResource
    {
        return MinifiedDocumentResource::collection($this->project->documents()->get());
    }

    public function destroy(Document $document): JsonResponse
    {
        $document->delete();
        return responseOk();
    }
}
