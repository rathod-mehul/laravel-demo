<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InvokableController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# Users Routes
Route::get('users', [UserController::class, 'index']);
Route::get('create-user', [UserController::class, 'create']);
Route::post('store-user', [UserController::class, 'store']);
Route::get('edit-user/{id}', [UserController::class, 'edit']);
Route::put('update-user/{id}', [UserController::class, 'update']);
Route::get('delete-user/{id}', [UserController::class, 'destroy']);

// Route::view('argon-dashboard', 'argon_dashboard.pages.dashboard');
// Route::view('argon-dashboard', 'argon_dashboard.pages.users');

// Route::get('/', function () {
//     return view('home');
// });
// Route::view('/', 'welcome');
// Route::view('/', 'layouts.app');
Route::view('/', 'argon_dashboard.pages.dashboard');
Route::view('page-2', 'pages.page2');
Route::view('page-3', 'pages.page3');
Route::view('form', 'pages.form');

Route::get('/greeting/{name?}', function (Request $request, $name = 'Default User') {
    // return 'Hello ' . $name;
    // return $request->all();
    return $request->name;
});
// Route::get('user/{id?}', [DemoController::class, 'index']);
// Route::get('get-name', [DemoController::class, 'getName']);
// Route::get('get-subject', [DemoController::class, 'getSubject']);

// Group controller
Route::controller(DemoController::class)->group(function () {
    Route::get('user/{id?}', 'index');
    Route::get('get-name', 'getName');
    Route::get('get-subject', 'getSubject')->name('get.subject');
    Route::get('blade-directive', 'bladeDirective');
});
Route::get('invokable-controller', InvokableController::class);
// Route::redirect('/', 'user');

// Route::group(['prefix' => 'users'], function () {
//     Route::get('/greeting/{name?}', function (Request $request, $name = 'Default User') {

//     });
// });

// Route::resource('photos', PhotoController::class);
// Route::singleton('profile', PhotoController::class);

Route::post('form-submit', [FormController::class, 'store'])->name('form.submit');

Route::fallback(function () {
    return 'Route Not Exists';
});
