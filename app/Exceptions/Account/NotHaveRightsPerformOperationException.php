<?php

namespace App\Exceptions\Account;

use Exception;

class NotHaveRightsPerformOperationException extends Exception
{
    protected $message = 'NotHaveRightsPerformOperation';

    public function render()
    {
        return response()->json([
            'status' => 'failed',
            'message' => __('exceptions.NotHaveRightsPerformOperation'),
        ], 403);
    }
}
