<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Dashboard route
Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');

Route::prefix('admin')->group(function () {
    //Admin login and register route
    Route::get('/register', 'App\Http\Controllers\AdminController@register')->name('admin.register');
    Route::get('/login', 'App\Http\Controllers\AdminController@login')->name('admin.login');


    // Admin users routes
    Route::get('/users', 'App\Http\Controllers\UserController@view')->name('admin.users');
    Route::get('/users/add', 'App\Http\Controllers\UserController@add')->name('admin.user.add');
    Route::post('/users/store', 'App\Http\Controllers\UserController@store')->name('admin.user.store');
    Route::post('/users/status-update', 'App\Http\Controllers\UserController@userStatusUpdate');
    Route::delete('/users/delete/{id}', 'App\Http\Controllers\UserController@userDelete')->name('admin.user.delete');
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UserController@userEdit')->name('admin.user.edit');
    Route::patch('/users/update/{id}', 'App\Http\Controllers\UserController@userUpdate')->name('admin.user.update');
});

Route::prefix('/user')->group(function () {
    //user profile route
    Route::get('/profile/view', 'App\Http\Controllers\UserController@profileView')->name('user.profile.view');
    Route::get('/profile/edit/{id}', 'App\Http\Controllers\UserController@profileEdit')->name('user.profile.edit');
    Route::put('/profile/update/{id}', 'App\Http\Controllers\UserController@profileUpdate')->name('user.profile.update');
    Route::get('/change/password', 'App\Http\Controllers\UserController@userChangePassword')->name('user.change.password');
    Route::post('/change/password/update', 'App\Http\Controllers\UserController@userChangePasswordUpdate')->name('user.change.password.update');
});
