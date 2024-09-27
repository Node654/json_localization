<?php

namespace App\Exceptions\Account;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidUserCredentialsException extends Exception
{
    protected $message = 'InvalidUserCredentials';

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => __("exceptions.{$this->getMessage()}")
        ], 401);
    }
}
