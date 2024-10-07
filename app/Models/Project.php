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

    protected $with = ['sourceLanguage', 'user'];

    protected $fillable = [
        'name',
        'description',
        'use_machine_translate',
        'source_language_id',
        'target_language_ids',
        'user_id',
        'progress'
    ];

    protected $casts = [
        'use_machine_translate' => 'boolean',
        'target_language_ids' => 'array'
    ];

    public function sourceLanguage(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'source_language_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function targetLanguages(): Collection
    {
        return Language::whereIn('id', $this->target_language_ids)->get();
    }
}
