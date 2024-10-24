<?php

namespace App\Exceptions\Assign;

use Exception;
use Illuminate\Http\JsonResponse;

class AppointmentExecutorForTheProjectException extends Exception
{
    protected $message  = 'AppointmentExecutorForTheProject';

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => __('exceptions.AppointmentExecutorForTheProject')
        ], 403);
    }
}
