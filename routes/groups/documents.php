<?php

use App\Http\Controllers\Api\v1\Document\DocumentController;
use App\Http\Middleware\Api\v1\CheckProjectRefersToUser;
use Illuminate\Support\Facades\Route;

Route::controller(DocumentController::class)->middleware('auth:sanctum')->prefix('/v1/documents')->group(function () {
    Route::post('/', 'addDocuments')->name('documents.add')->middleware(CheckProjectRefersToUser::class);
});
