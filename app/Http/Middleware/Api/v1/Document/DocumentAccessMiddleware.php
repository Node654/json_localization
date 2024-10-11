<?php

namespace App\Http\Middleware\Api\v1\Document;

use App\Exceptions\Account\NotHaveRightsPerformOperationException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $document = $request->route('document');

        $project = $document->project;

        if (! is_null($project) && ! $project->hasAccess())
        {
            throw new NotHaveRightsPerformOperationException();
        }

        return $next($request);
    }
}
