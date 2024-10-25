<?php

namespace App\Services\Performer;

use App\Http\Resources\Api\v1\Performer\PerformerProjectsResource;
use App\Models\Performer;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PerformerService
{
    public function index(): AnonymousResourceCollection
    {
        $projects = Project::query()->where('user_id', auth()->id())->get();
        return PerformerProjectsResource::collection($projects);
    }

    public function store(array $data): JsonResponse
    {
        $performer = Performer::where('user_id', $data['performerId'])->firstOrFail();
        $performer->projects()->sync([
            'project_id' => $data['projectId']
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
