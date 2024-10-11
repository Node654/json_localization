<?php

namespace App\Http\Middleware\Api\v1\Document;

use App\Exceptions\Account\NotHaveRightsPerformOperationException;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentListMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *
     * @throws NotHaveRightsPerformOperationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var Project $project
         */
        $project = Project::query()->find($request->get('projectId'));

        if (! is_null($project) && ! $project->hasAccess()) {
            throw new NotHaveRightsPerformOperationException;
        }

        return $next($request);
    }
}
