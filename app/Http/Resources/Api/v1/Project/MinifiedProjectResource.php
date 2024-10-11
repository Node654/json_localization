<?php

namespace App\Http\Resources\Api\v1\Project;

use App\Http\Resources\Api\v1\Language\LanguageResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinifiedProjectResource extends JsonResource
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
                'source' => new LanguageResource($this->sourceLanguage),
                'target' => LanguageResource::collection($this->targetLanguages()),
            ],
            'performersCount' => 0,
            'documentsCount' => 0,
            'usedMachineTranslate' => $this->use_machine_translate,
            'createdAt' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
        ];
    }
}
