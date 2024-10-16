<?php

namespace App\Exceptions\Account;

use Exception;
use Illuminate\Http\JsonResponse;

class NotHaveRightsPerformOperationException extends Exception
{
    protected $message = 'NotHaveRightsPerformOperation';

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => __('exceptions.NotHaveRightsPerformOperation'),
        ], 403);
    }
}
