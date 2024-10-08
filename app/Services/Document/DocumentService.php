<?php

namespace App\Services\Document;

use App\Models\Project;
use Illuminate\Http\JsonResponse;

class DocumentService
{
    private Project $project;

    public function addDocuments(array $documents): JsonResponse
    {
        $this->project->documents()->createMany($documents);
        return responseOk();
    }

    public function setProject(Project|int $project): DocumentService
    {
        $this->project = $project instanceof Project ? $project : Project::find($project);
        return $this;
    }
}
