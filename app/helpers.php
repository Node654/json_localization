<?php

use Illuminate\Http\JsonResponse;

function redirectOk(): JsonResponse
{
    return response()->json([
        'status' => 'success'
    ]);
}
