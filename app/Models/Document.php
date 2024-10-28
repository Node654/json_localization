<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'project_id',
        'name',
        'data',
        'progress',
    ];

    protected $casts = ['data' => 'array', 'progress' => 'float'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getStatus(): string
    {
        switch (true) {
            case $this->progress === 100:
                return 'completed';
            case $this->progress > 0 && $this->progress < 100:
                return 'in progress';
            default:
                return 'created';
        }
    }

    public function translations(): HasMany
    {
        return $this->hasMany(Translation::class, 'document_id', 'id');
    }

    public function getShowData(string $locale): array
    {
        $language = Language::query()->where('locale', $locale)->first();
        $translation = Translation::query()->where(['document_id' => $this->id, 'language_id' => $language->id])->first();
        $dataDocument = [];
        foreach ($this->data as $item) {
            $translatedValue = Arr::first($translation->data, function ($el) use ($item) {
                return $el['key'] === $item['key'];
            });

            $data['key'] = $item['key'];
            $data['original'] = $item['value'];
            if (! is_null($translatedValue)) {
                $data['translation'] = $translatedValue['value'];
            }
            $dataDocument[] = $data;
        }

        return $dataDocument;
    }

    public function getTotalSegmentTranslated(): int
    {
        $totalTranslatedDocumentValues = 0;
        foreach ($this->translations as $translation) {
            $translatedDocumentValues = Arr::where($translation->data, function ($el) {
                return ! empty($el['value']) && is_string($el['value']);
            });
            if (! empty($translatedDocumentValues)) {
                $totalTranslatedDocumentValues += count($translatedDocumentValues);
            }
        }

        return $totalTranslatedDocumentValues;
    }

    public function getTotalSegments(): int
    {
        return count($this->data) * count($this->project->target_language_ids);
    }
}
