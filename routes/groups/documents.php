<?php

use App\Http\Controllers\Api\v1\Document\DocumentController;
use App\Http\Middleware\Api\v1\CheckProjectRefersToUser;
use App\Http\Middleware\Api\v1\Document\DocumentAccessMiddleware;
use App\Http\Middleware\Api\v1\Document\DocumentListMiddleware;
use Illuminate\Support\Facades\Route;

Route::controller(DocumentController::class)->middleware('auth:sanctum')->prefix('/v1/documents')->group(function () {
    Route::post('/', 'add')->name('documents.add')->middleware(CheckProjectRefersToUser::class);
    Route::get('', 'list')->name('documents.list')->middleware(DocumentListMiddleware::class);
    Route::delete('/{document}', 'destroy')->name('documents.destroy')->middleware(DocumentAccessMiddleware::class);
    Route::post('/{document}/import', 'importTranslations')->name('documents.import')->middleware(DocumentAccessMiddleware::class);
});
