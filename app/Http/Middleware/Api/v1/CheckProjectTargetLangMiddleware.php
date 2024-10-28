<?php

namespace App\Http\Middleware\Api\v1;

use App\Exceptions\Lang\ProjectTargetLanguageSelectedException;
use App\Models\Document;
use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProjectTargetLangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var Document $document
         */
        $document = $request->route('document');
        /**
         * @var Project $project
         */
        $project = $document->project;
        if (! $project->hasTargetLanguage($request->input('locale'))) {
            throw new ProjectTargetLanguageSelectedException;
        }

        return $next($request);
    }
}
