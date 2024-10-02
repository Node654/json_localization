<?php

namespace App\Http\Controllers\Api\v1\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Project\StoreProjectRequest;
use App\Http\Requests\Api\v1\Project\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreProjectRequest $request)
    {
        return $request->createProject();
    }

    public function show(Project $project)
    {
        //
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    public function destroy(Project $project)
    {
        //
    }
}
