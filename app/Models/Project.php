<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'progress',
    ];

    protected $casts = [
        'use_machine_translate' => 'boolean',
        'target_language_ids' => 'array',
        'progress' => 'float'
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

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'project_id', 'id');
    }

    public function authUserCheck(): bool
    {
        return $this->user_id === authUserId();
    }

    public function hasAccess(): bool
    {
        return $this->authUserCheck();
    }

    public function hasTargetLanguage(int|string $locale): bool
    {
        if (is_int($locale))
        {
            return in_array($locale, $this->target_language_ids);
        } else {
            $language = Language::query()->where('locale', $locale)->first();
            return in_array($language->id, $this->target_language_ids);
        }
    }
}
