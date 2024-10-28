<?php

namespace App\Http\Resources\Api\v1\Document;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowDocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'data' => $this->getShowData($request->input('locale')),
        ];
    }
}
