<?php

use App\Http\Controllers\Api\v1\Account\AccountController;
use Illuminate\Support\Facades\Route;


Route::controller(AccountController::class)->prefix('/v1/accounts')->group(function () {
    Route::post('create', 'store')->name('account.store');
    Route::post('sign-in', 'signIn')->name('account.signIn');
    Route::get('/authorized', 'show')->name('account.show')->middleware('auth:sanctum');
});
