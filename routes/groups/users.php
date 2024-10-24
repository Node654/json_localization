<?php

use App\Http\Controllers\Api\v1\User\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->controller(UserController::class)->prefix('/v1/users')->group(function () {
    Route::get('', 'index');
});
