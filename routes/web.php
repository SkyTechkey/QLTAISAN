<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Gate;
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

Route::get('/dashboard', function () {
    if (! Gate::allows('is-admin')) {
        return redirect()->route('content.index');
    }
    else{
        return view('dashboard.dashboard');
    }
   
})->middleware(['auth'])->name('dashboard');



Route::get('/admin', function () {
    if (! Gate::allows('is-admin')) {
        abort(403);
    }
    else{
        return view('admin');
    }
   
})->name('admin');

require __DIR__.'/auth.php';

Route::resource('content',ContentController::class);
Route::resource('user',UserController::class);
Route::resource('department',DepartmentController::class);
Route::put('user/changrole',[UserController::class,'change_role'])->name('user.change_role');
