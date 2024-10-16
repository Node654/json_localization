<?php

namespace App\Exceptions\Lang;

use Exception;
use Illuminate\Http\JsonResponse;

class ProjectTargetLanguageSelectedException extends Exception
{
    protected $message = 'InvalidSelectedTargetLanguage';

    public function render(): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'message' => __('exceptions.InvalidSelectedTargetLanguage'),
        ]);
    }
}
