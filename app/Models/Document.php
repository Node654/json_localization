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
    ];

    protected $casts = ['data' => 'array'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getStatus(): string
    {
        $progress = $this->project->progress;

        switch ($progress)
        {
            case $progress === 100:
                return 'completed';
            case $progress > 0 && $progress < 100:
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
        foreach ($this->data as $item)
        {
            $translatedValue = Arr::first($translation->data, function ($el) use ($item) {
                return $el['key'] === $item['key'];
            });

            $data['key'] = $item['key'];
            $data['original'] = $item['value'];
            if (! is_null($translatedValue))
            {
                $data['translation'] = $translatedValue['value'];
            }
            $dataDocument[] = $data;
        }

        return $dataDocument;
    }
}
