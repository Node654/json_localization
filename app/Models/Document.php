<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
