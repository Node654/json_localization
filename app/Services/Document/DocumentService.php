<?php

namespace App\Services\Document;

use App\Http\Resources\Api\v1\Document\MinifiedDocumentResource;
use App\Http\Resources\Api\v1\Document\ShowDocumentResource;
use App\Models\Document;
use App\Models\Language;
use App\Models\Project;
use App\Models\Translation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use LaravelLang\LocaleList\Locale;
use LaravelLang\Translator\Facades\Translate;

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
        if (isset($translationsData['data'])) {
            $translatedData = [];

            $existingTranslations = Translation::query()->where(
                [
                    'document_id' => $this->document->id,
                    'language_id' => $translationsData['locale'],
                ]
            )->first();

            $sourceData = is_null($existingTranslations) ? $this->document->data : $existingTranslations->data;

            foreach ($sourceData as $key => $item) {
                $translationsFilteredData = Arr::first($translationsData['data'], function ($el) use ($item) {
                    return $el['key'] === $item['key'];
                });

                if (is_null($translationsFilteredData)) {
                    if (is_null($existingTranslations)) {
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
                'data' => $translatedData,
            ]);
        }

        if (isset($translationsData['use_machine_translate']) && ! isset($translationsData['data'])) {
            dd(Translation::where('id', 4)->get()->toArray());
            $machineTranslatedData = [];
            $language = Language::where('id', $translationsData['locale'])->first();
            $locale = $language->locale;
            foreach ($this->document->data as $value)
            {
                $machineTranslatedData[] = Translate::viaGoogle($value, $locale);

            }

            Translation::query()->updateOrCreate([
                'document_id' => $this->document->id,
                'language_id' => $translationsData['locale'],
            ], [
                'data' => $machineTranslatedData,
            ]);
        }

        $this->updateProgressDocument();

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

    private function updateProgressDocument(): void
    {
        $totalSegments = $this->document->getTotalSegments();
        $totalSegmentsTranslated = $this->document->getTotalSegmentTranslated();
        $progress = number_format(($totalSegmentsTranslated / $totalSegments) * 100, 2);
        $this->document->update([
            'progress' => $progress,
        ]);
    }
}
