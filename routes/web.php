<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('/login/check', [AuthController::class, 'onLogin'])->name('login.check');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware'=> ['AuthCheck']], function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
});