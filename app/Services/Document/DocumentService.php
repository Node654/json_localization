<?php

namespace App\Services\Document;

use App\Http\Resources\Api\v1\Document\DocumentResource;
use App\Http\Resources\Api\v1\Document\MinifiedDocumentResource;
use App\Http\Resources\Api\v1\Document\ShowDocumentResource;
use App\Models\Document;
use App\Models\Project;
use App\Models\Translation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class DocumentService
{
    private Project $project;
    private Document $document;

    public function addDocuments(array $documents): JsonResponse
    {
        $this->project->documents()->createMany($documents);

        return responseCreated();
    }

    public function setProject(Project|int $project): DocumentService
    {
        $this->project = $project instanceof Project ? $project : Project::find($project);

        return $this;
    }

    public function list(): JsonResource
    {
        return MinifiedDocumentResource::collection($this->project->documents()->get());
    }

    public function importTranslations(array $translationsData): JsonResponse
    {
        $translatedData = [];

        $existingTranslations = Translation::query()->where(
            [
                'document_id' => $this->document->id,
                'language_id' => $translationsData['locale'],
            ]
        )->first();

        $sourceData = is_null($existingTranslations) ? $this->document->data : $existingTranslations->data;

        foreach ($sourceData as $key => $item)
        {
            $translationsFilteredData = Arr::first($translationsData['data'], function ($el) use ($item)
            {
                return $el['key'] === $item['key'];
            });

            if (is_null($translationsFilteredData))
            {
                if (is_null($existingTranslations))
                {
                    $item['value'] = '';
                }
                $translatedData[] = $item;
            } else {
                $translatedData[] = $translationsFilteredData;
            }
        }

        Translation::query()->updateOrCreate([
            'document_id' => $this->document->id,
            'language_id' => $translationsData['locale'],
        ], [
            'data' => $translatedData
        ]);

        return responseOk();
    }

    public function getDocument(): JsonResource
    {
        return new ShowDocumentResource($this->document);
    }

    public function setDocument(Document $document): DocumentService
    {
        $this->document = $document;
        return $this;
    }

    public function destroy(Document $document): JsonResponse
    {
        $document->delete();
        return responseOk();
    }
}
