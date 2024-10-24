<?php

namespace App\Http\Controllers\Api\v1\Performer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Performer\StoreRequest;
use App\Models\Performer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PerformerController extends Controller
{
    public function store(StoreRequest $request): JsonResponse
    {
        return $request->storePerformer();
    }

    public function destroy(Performer $performer)
    {
        $performer->projects()->detach();
        return responseOk();
    }
}
