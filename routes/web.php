<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\InvokableController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserAjaxController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TestMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# Users Routes
// Route::get('users', [UserController::class, 'index'])->name('users.index');
// Route::get('create-user', [UserController::class, 'create'])->name('users.create');
// Route::post('store-user', [UserController::class, 'store'])->name('users.store');
// Route::get('edit-user/{id}', [UserController::class, 'edit'])->name('users.edit');
// Route::put('update-user/{id}', [UserController::class, 'update'])->name('users.update');
// Route::delete('delete-user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::get('show-user/{id}', [UserController::class, 'show'])->name('users.show');



// Route::view('argon-dashboard', 'argon_dashboard.pages.dashboard');
// Route::view('argon-dashboard', 'argon_dashboard.pages.users');
Route::view('email-page', 'mail.user-email');
Route::view('login', 'auth.login')->middleware('guest');
Route::post('login', [LoginController::class, 'login'])->name('login');

// Route::get('/', function () {
//     return view('home');
// });
// Route::view('/', 'welcome');
// Route::view('/', 'layouts.app');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('users-ajax', UserAjaxController::class);
    Route::view('users-ajax-page', 'argon_dashboard.pages.users_ajax.index');
    Route::view('/', 'argon_dashboard.pages.dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('get-todos', [DemoController::class, 'getTodos'])->middleware(TestMiddleware::class);
    // Route::get('get-todos', [DemoController::class, 'getTodos'])->withoutMiddleware('auth'); // can be access guest user
});

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
    Route::get('model-naming', 'modelNaming');
    Route::get('encrypt-decrypt', 'encryptDecrypt');
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
