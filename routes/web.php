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

Route::get('/allUsers', 'App\Http\Controllers\StudioController@index')->name('all.users');

Route::get('/app', function() {
    return view('layouts.app');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/studio/{id}', [App\Http\Controllers\StudioController::class, 'show'])->name('studios.show');

Route::post('/studio/book', [App\Http\Controllers\BookingController::class, 'create'])->name('studios.book');
