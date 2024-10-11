<?php

namespace App\Facades;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static setProject(\App\Models\Project $project)
 * @method static \Illuminate\Http\JsonResponse addDocuments()
 * @method static JsonResource list()
 *
 * @see \App\Services\Document\DocumentService
 */
class Document extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'document_service';
    }
}
