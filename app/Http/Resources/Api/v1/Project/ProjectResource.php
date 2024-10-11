<?php

namespace App\Http\Resources\Api\v1\Project;

use App\Http\Resources\Api\v1\Language\LanguageResource;
use App\Http\Resources\Api\v1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProjectResource extends JsonResource
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
            'user_id' => new UserResource($this->user),
            'name' => $this->name,
            'description' => $this->description,
            'progress' => $this->progress,
            'languages' => [
                'source' => new LanguageResource($this->sourceLanguage),
                'target' => LanguageResource::collection($this->targetLanguages()),
            ],
            'documents' => [],
            'performers' => [],
            'settings' => [
                'useMachineTranslate' => $this->use_machine_translate,
            ],
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
