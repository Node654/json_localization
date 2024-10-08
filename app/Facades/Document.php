<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static  setProject(\App\Models\Project $project)
 * @method static \Illuminate\Http\JsonResponse addDocuments()
 * @see \App\Services\Document\DocumentService
 */
class Document extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'document_service';
    }
}
