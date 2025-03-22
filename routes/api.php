<?php

use App\Http\Controllers\UserAjaxController;
use App\Http\Controllers\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('users-ajax', UserAjaxController::class);
Route::resource('users', UserAPIController::class);
