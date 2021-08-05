<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentDetailController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
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

Route::resource('content',ContentController::class)->middleware('auth');
Route::resource('content-detail',ContentDetailController::class)->middleware('auth');
Route::resource('user',UserController::class)->middleware('auth');
Route::resource('department',DepartmentController::class)->middleware('auth');
Route::resource('role',RoleController::class)->middleware('auth');
Route::resource('permission',PermissionController::class)->middleware('auth');
Route::put('user/changerole',[UserController::class,'change_role'])->name('user.change_role')->middleware('auth');

