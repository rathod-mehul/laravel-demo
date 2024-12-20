<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\InvokableController;
use App\Http\Controllers\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
// Route::view('/', 'welcome');
Route::view('/', 'home');

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
});
Route::get('invokable-controller', InvokableController::class);
// Route::redirect('/', 'user');

// Route::group(['prefix' => 'users'], function () {
//     Route::get('/greeting/{name?}', function (Request $request, $name = 'Default User') {

//     });
// });

// Route::resource('photos', PhotoController::class);
// Route::singleton('profile', PhotoController::class);

//cheack git statuse