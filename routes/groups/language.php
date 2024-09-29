<?php

use App\Http\Controllers\Api\v1\Language\LanguageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->controller(LanguageController::class)->prefix('/v1/languages')->group(function () {
    Route::get('/', 'index')->name('language.index');
    Route::post('/', 'store')->name('language.store');
});
