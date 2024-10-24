<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Performer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    protected $table = 'performers';

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_performer', 'performer_id', 'project_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
