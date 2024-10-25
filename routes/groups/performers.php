<?php

use App\Http\Controllers\Api\v1\Performer\PerformerController;
use App\Http\Middleware\Api\v1\AssignPerformer\CheckingIfThereIsAccessToTheProject;
use App\Http\Middleware\Api\v1\AssignPerformer\CheckThereAccessAssignDelete;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->controller(PerformerController::class)->prefix('/v1/team')->group(function () {
    Route::post('assign-performer', 'store')->middleware(CheckingIfThereIsAccessToTheProject::class);
    Route::delete('assign/delete/{performer}', 'destroy')->middleware(CheckThereAccessAssignDelete::class);
    Route::get('projects', 'index');
});
