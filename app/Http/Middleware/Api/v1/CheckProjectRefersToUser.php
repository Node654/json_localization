<?php

namespace App\Http\Middleware\Api\v1;

use App\Exceptions\Account\NotHaveRightsPerformOperationException;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectRefersToUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $project = Project::query()->findOrFail($request->input('projectId'));

        if (! is_null($project) && ! $project->authUserCheck())
        {
            throw new NotHaveRightsPerformOperationException();
        }

        return $next($request);
    }
}
