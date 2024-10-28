<?php

namespace App\Exceptions\Assign;

use Exception;
use Illuminate\Http\JsonResponse;

class CheckingWhetherTheUserHasAccessToDeleteThePerformerException extends Exception
{
    protected $message = 'CheckingWhetherTheUserHasAccessToDeleteThePerformer';

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => __('exceptions.CheckingWhetherTheUserHasAccessToDeleteThePerformer'),
        ], 401);
    }
}
