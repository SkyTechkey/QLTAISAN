<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentDetailController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\ContentType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $types = ContentType::all();
    Session::put('types',$types);
    if (! Gate::allows('is-admin')) {
        return redirect()->route('content.index');
    }
    else{
        return view('dashboard.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

Route::resource('content',ContentController::class)->middleware('auth');
Route::get('search-folder', [ContentController::class, 'searchFolder'])->name('searchFolder')->middleware('auth');
Route::resource('content-detail', ContentDetailController::class)->middleware('auth');
Route::get('search-file', [ContentDetailController::class, 'searchFile'])->name('searchFile')->middleware('auth');
Route::get('content-detail/download/{id}', [ContentDetailController::class, 'download'])->middleware('auth');
Route::resource('user',UserController::class)->middleware('auth');
Route::resource('department',DepartmentController::class)->middleware('auth');
Route::resource('role',RoleController::class)->middleware('auth');
Route::resource('permission',PermissionController::class)->middleware('auth');

