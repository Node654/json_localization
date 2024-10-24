<?php

namespace App\Http\Middleware\Api\v1\AssignPerformer;

use App\Exceptions\Assign\AppointmentExecutorForTheProjectException;
use App\Models\Performer;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckingIfThereIsAccessToTheProject
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws AppointmentExecutorForTheProjectException
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var Project $project
         */
        $project = Project::find($request->input('projectId'));
        $performer = Performer::where('user_id', $request->input('performerId'))->first();

        if (! $project->hasAccess() && $performer)
        {
            throw new AppointmentExecutorForTheProjectException();
        }

        return $next($request);
    }
}
