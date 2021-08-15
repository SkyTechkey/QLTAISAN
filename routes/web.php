<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentDetailController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\ContentType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, "index"])->middleware(['auth'])->name('dashboard');
Route::resource('content', ContentController::class)->middleware('auth');
Route::post('search-folder', [ContentController::class, 'searchFolder'])->name('searchFolder')->middleware('auth');
Route::resource('content-detail', ContentDetailController::class)->middleware('auth');
Route::post('search-file', [ContentDetailController::class, 'searchFile'])->name('searchFile')->middleware('auth');
Route::post('search-files', [ContentDetailController::class, 'searchFiles'])->name('searchFiles')->middleware('auth');
Route::get('content-detail/download/{id}', [ContentDetailController::class, 'download'])->middleware('auth');
Route::resource('user',UserController::class)->middleware('auth');
Route::resource('department',DepartmentController::class)->middleware('auth');
Route::resource('role',RoleController::class)->middleware('auth');
Route::resource('permission',PermissionController::class)->middleware('auth');

