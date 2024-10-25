<?php

namespace App\Http\Resources\Api\v1\Performer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PerformerProjectsResource extends JsonResource
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
            'languages' => [
                'source' => $this->source_language_id,
                'target' => $this->target_language_ids
            ],
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y H:i')
        ];
    }
}
