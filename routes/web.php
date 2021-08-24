<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// kiểm tra đăng nhập
Route::post('/login/check', [AuthController::class, 'onLogin'])->name('login.check');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// đăng nhập
Route::group(['middleware'=> ['AuthCheck']], function() {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});
// Xử lý chi nhánh

// Xử lý đơn vị

// Xử lý phòng ban

// xử lý nhân viên
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class,'index'])->middleware(['permission:view_user'])->name('user.index');
    Route::get('/{id}', [UserController::class,'show'])->middleware(['permission:view_user'])->name('user.show');
    Route::get('/create', [UserController::class,'create'])->middleware(['permission:create_user'])->name('user.create');
    Route::post('/', [UserController::class,'store'])->middleware(['permission:create_user'])->name('user.store');
    Route::get('/{id}/edit', [UserController::class,'edit'])->middleware(['permission:update_user'])->name('user.update');
    Route::put('/{id}', [UserController::class,'update'])->middleware(['permission:update_user'])->name('user.update');
    Route::delete('/{id}', [UserController::class,'destroy'])->middleware(['permission:delete_user'])->name('user.destroy');
});
