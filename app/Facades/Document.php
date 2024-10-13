<?php

namespace App\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\Document\DocumentService setProject(\App\Models\Project $project)
 * @method static \App\Services\Document\DocumentService setDocument(\App\Models\Document $document)
 * @method static \Illuminate\Http\JsonResponse addDocuments()
 * @method static JsonResource list()
 * @method static JsonResponse destroy(\App\Models\Document $document)
 * @method static JsonResponse importTranslations(array $data)
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
