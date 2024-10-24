<?php

namespace App\Services\Performer;

use App\Models\Performer;
use Illuminate\Http\JsonResponse;

class PerformerService
{
    public function store(array $data): JsonResponse
    {
        $performer = Performer::where('user_id', $data['performerId'])->firstOrFail();
        $performer->projects()->sync([
            'project_id' => $data['projectId']
        ]);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
