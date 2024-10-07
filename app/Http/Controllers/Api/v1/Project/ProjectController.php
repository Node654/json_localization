<?php

namespace App\Http\Controllers\Api\v1\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Project\StoreProjectRequest;
use App\Http\Requests\Api\v1\Project\UpdateProjectRequest;
use App\Http\Resources\Api\v1\Project\MinifiedProjectResource;
use App\Http\Resources\Api\v1\Project\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectController extends Controller
{
    public function index()
    {
        return MinifiedProjectResource::collection(Project::query()->where('user_id', authUserId())->get());
    }

    public function store(StoreProjectRequest $request)
    {
        return $request->createProject();
    }

    public function show(Project $project): JsonResource
    {
        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, Project $project): JsonResource
    {
        return $request->update($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirectOk();
    }
}
