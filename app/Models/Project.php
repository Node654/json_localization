<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'use_machine_translate',
        'source_language_id',
        'target_language_ids'
    ];

    protected $casts = [
        'use_machine_translate' => 'boolean',
        'target_language_ids' => 'array'
    ];

    public function sourceLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'source_language_id');
    }

    public function targetLanguages(): Collection
    {
        return Language::whereIn('id', $this->target_language_ids)->get();
    }
}
