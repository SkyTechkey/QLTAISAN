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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/content', [App\Http\Controllers\HomeController::class, 'content'])->name('content');
Route::get('/content1', [App\Http\Controllers\HomeController::class, 'content1'])->name('content1');
Route::get('/content2', [App\Http\Controllers\HomeController::class, 'content2'])->name('content2');
Route::get('/calendar', [App\Http\Controllers\HomeController::class, 'calendar'])->name('calendar');
Route::get('/gallery', [App\Http\Controllers\HomeController::class, 'gallery'])->name('gallery');
