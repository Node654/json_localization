<?php

namespace App\Http\Resources\Api\v1\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinifiedDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->getStatus(),
            'progress' => $this->project->progress,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
