<?php

namespace App\Http\Middleware\Api\v1\AssignPerformer;

use App\Exceptions\Assign\CheckingWhetherTheUserHasAccessToDeleteThePerformerException;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckThereAccessAssignDelete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $performer = $request->route('performer');
        $projects = $performer->projects;
        foreach ($projects as $project) {
            /**
             * @var Project $project
             */
            if (! $project->hasAccess()) {
                throw new CheckingWhetherTheUserHasAccessToDeleteThePerformerException;
            }
        }

        return $next($request);
    }
}
