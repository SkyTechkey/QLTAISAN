<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvideController;
use App\Http\Controllers\PropertyGroupController;
use App\Http\Controllers\PropertyTypeController;

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
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile-update/{id}', [AuthController::class, 'profileUpdate'])->name('profile.update');
});
// Xử lý đơn vị
Route::prefix('unit')->middleware(['auth'])->group(function () {
    Route::get('/', [UnitController::class,'index'])->middleware(['permission:view_unit'])->name('unit.index');
    Route::put('/{id}', [UnitController::class,'update'])->middleware(['permission:update_unit'])->name('unit.update');
});

// Xử lý chi nhánh
Route::prefix('branch')->middleware(['auth'])->group(function () {
    Route::get('/', [BranchController::class,'index'])->middleware(['permission:view_branch|view_all_branch'])->name('branch.index');
    Route::get('/{id}', [BranchController::class,'show'])->middleware(['permission:view_branch'])->name('branch.show');
    Route::post('/', [BranchController::class,'store'])->middleware(['permission:create_branch'])->name('branch.store');
    Route::put('/{id}', [BranchController::class,'update'])->middleware(['permission:update_branch'])->name('branch.update');
    Route::delete('/{id}', [BranchController::class,'destroy'])->middleware(['permission:delete_branch'])->name('branch.destroy');
});
// Xử lý phòng ban
Route::prefix('department')->middleware(['auth'])->group(function () {
    Route::get('/', [DepartmentController::class,'index'])->middleware(['permission:view_department'])->name('department.index');
    Route::get('/{id}', [DepartmentController::class,'show'])->middleware(['permission:view_department'])->name('department.show');
    Route::post('/', [DepartmentController::class,'store'])->middleware(['permission:create_department'])->name('department.store');
    Route::put('/{id}', [DepartmentController::class,'update'])->middleware(['permission:update_department'])->name('department.update');
    Route::delete('/{id}', [DepartmentController::class,'destroy'])->middleware(['permission:delete_department'])->name('department.destroy');
});
// xử lý nhân viên
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->middleware(['permission:view_user'])->name('user.index');
    Route::get('/{id}', [UserController::class,'show'])->middleware(['permission:view_user'])->name('user.show');
    Route::get('/create', [UserController::class,'create'])->middleware(['permission:create_user'])->name('user.create');
    Route::post('/', [UserController::class, 'store'])->middleware(['permission:create_user'])->name('user.store');
    Route::get('/{id}/edit', [UserController::class,'edit'])->middleware(['permission:update_user'])->name('user.update');
    Route::put('/{id}', [UserController::class,'update'])->middleware(['permission:update_user'])->name('user.update');
    Route::delete('/{id}', [UserController::class,'destroy'])->middleware(['permission:delete_user'])->name('user.destroy');
});
// Xử lý Role
Route::prefix('role')->middleware(['auth'])->group(function () {
    Route::get('/', [RoleController::class,'index'])->middleware(['permission:view_role'])->name('role.index');
    Route::get('/{id}', [RoleController::class,'show'])->middleware(['permission:view_role'])->name('role.show');
    Route::post('/', [RoleController::class,'store'])->middleware(['permission:create_role'])->name('role.store');
    Route::put('/{id}', [RoleController::class,'update'])->middleware(['permission:update_role'])->name('role.update');
    Route::delete('/{id}', [RoleController::class,'destroy'])->middleware(['permission:delete_role'])->name('role.destroy');
});
// Xử lý permission
Route::prefix('permission')->middleware(['auth'])->group(function () {
    Route::get('/', [PermissionController::class,'index'])->middleware(['permission:view_permission'])->name('permission.index');
    Route::get('/{id}', [PermissionController::class,'show'])->middleware(['permission:view_permission'])->name('permission.show');
    Route::post('/', [PermissionController::class,'store'])->middleware(['permission:create_permission'])->name('permission.store');
    Route::put('/{id}', [PermissionController::class,'update'])->middleware(['permission:update_permission'])->name('permission.update');
    Route::delete('/{id}', [PermissionController::class,'destroy'])->middleware(['permission:delete_permission'])->name('permission.destroy');
});
// Nhà cung cấp
Route::prefix('provide')->middleware(['auth'])->group(function () {
    Route::get('/', [ProvideController::class,'index'])->middleware(['permission:view_provide'])->name('provide.index');
    Route::get('/{id}', [ProvideController::class,'show'])->middleware(['permission:view_provide'])->name('provide.show');
    Route::post('/', [ProvideController::class,'store'])->middleware(['permission:create_provide'])->name('provide.store');
    Route::put('/{id}', [ProvideController::class,'update'])->middleware(['permission:update_provide'])->name('provide.update');
    Route::delete('/{id}', [ProvideController::class,'destroy'])->middleware(['permission:delete_provide'])->name('provide.destroy');
});
// Loại tài sản
Route::prefix('property_type')->middleware(['auth'])->group(function () {
    Route::get('/', [PropertyTypeController::class,'index'])->middleware(['permission:view_property_type'])->name('property_type.index');
    Route::get('/{id}', [PropertyTypeController::class,'show'])->middleware(['permission:view_property_type'])->name('property_type.show');
    Route::post('/', [PropertyTypeController::class,'store'])->middleware(['permission:create_property_type'])->name('property_type.store');
    Route::put('/{id}', [PropertyTypeController::class,'update'])->middleware(['permission:update_property_type'])->name('property_type.update');
    Route::delete('/{id}', [PropertyTypeController::class,'destroy'])->middleware(['permission:delete_property_type'])->name('property_type.destroy');
});

// Nhóm sản phẩm
Route::prefix('property_group')->middleware(['auth'])->group(function () {
    Route::get('/', [PropertyGroupController::class,'index'])->middleware(['permission:view_property_group'])->name('property_group.index');
    Route::get('/{id}', [PropertyGroupController::class,'show'])->middleware(['permission:view_property_group'])->name('property_group.show');
    Route::post('/', [PropertyGroupController::class,'store'])->middleware(['permission:create_property_group'])->name('property_group.store');
    Route::put('/{id}', [PropertyGroupController::class,'update'])->middleware(['permission:update_property_group'])->name('property_group.update');
    Route::delete('/{id}', [PropertyGroupController::class,'destroy'])->middleware(['permission:delete_property_group'])->name('property_group.destroy');
});



// 
Route::get('/get-department/{id}', [DepartmentController::class, 'getDepartments']);
Route::get('/get-user/{id}', [UserController::class, 'getUsers']);

// 
Route::get('/assets', function() {
    return view('assets.index');
});

