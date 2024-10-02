<?php

namespace App\Http\Resources\Api\v1\Project;

use App\Http\Resources\Api\v1\Language\LanguageResource;
use App\Http\Resources\Api\v1\Language\SourceLanguage;
use App\Http\Resources\Api\v1\Language\TargetResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'name' => $this->name,
            'description' => $this->description,
            'languages' => [
                'source' => new LanguageResource($this->sourceLanguage),
                'target' => LanguageResource::collection($this->targetLanguages()),
            ],
            'settings' => [
                'useMachineTranslate' => $this->use_machine_translate
            ],
            'createdAt' => $this->created_at->format('Y-m-d H:i')
        ];
    }
}
