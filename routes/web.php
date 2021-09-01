<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetsDetailsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DetailDeliveryNoteController;
use App\Http\Controllers\DetailReceiptNoteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvideController;
use App\Http\Controllers\PropertyGroupController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\ReceiptNoteController;
use App\Http\Controllers\RepairCostController;
use App\Http\Controllers\FileUploadController;

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

// Nhóm tài sản
Route::prefix('property_group')->middleware(['auth'])->group(function () {
    Route::get('/', [PropertyGroupController::class,'index'])->middleware(['permission:view_property_group'])->name('property_group.index');
    Route::get('/{id}', [PropertyGroupController::class,'show'])->middleware(['permission:view_property_group'])->name('property_group.show');
    Route::post('/', [PropertyGroupController::class,'store'])->middleware(['permission:create_property_group'])->name('property_group.store');
    Route::put('/{id}', [PropertyGroupController::class,'update'])->middleware(['permission:update_property_group'])->name('property_group.update');
    Route::delete('/{id}', [PropertyGroupController::class,'destroy'])->middleware(['permission:delete_property_group'])->name('property_group.destroy');
});

// Xử lý tài sản
Route::prefix('assets')->middleware(['auth'])->group(function () {
    Route::get('/', [AssetController::class,'index'])
    ->middleware(['permission:view_assets'])
    ->name('assets.index');
    Route::get('/{id}', [AssetController::class,'show'])
    ->middleware(['permission:view_assets'])
    ->name('assets.show');
    Route::post('/', [AssetController::class,'store'])
    ->middleware(['permission:create_assets'])
    ->name('assets.store');
    Route::post('/create', [AssetController::class,'create'])
    ->middleware(['permission:create_assets'])
    ->name('assets.create');
    Route::put('/{id}', [AssetController::class,'update'])
    ->middleware(['permission:update_assets'])
    ->name('assets.update');
    Route::delete('/{id}', [AssetController::class,'destroy'])
    ->middleware(['permission:delete_assets'])
    ->name('assets.destroy');
});
// Xử lý chi tiết tài sản
Route::prefix('assets-detail')->middleware(['auth'])->group(function () {
    Route::get('/', [AssetsDetailsController::class,'index'])
    ->middleware(['permission:view_assets'])
    ->name('assets-detail.index');
    Route::get('/create', [AssetsDetailsController::class,'create'])
    ->middleware(['permission:view_assets'])
    ->name('assets-detail.create');
    Route::post('/', [AssetsDetailsController::class,'store'])
    ->middleware(['permission:create_assets'])
    ->name('assets-detail.store');
    Route::put('/{id}', [AssetsDetailsController::class,'update'])
    ->middleware(['permission:update_assets'])
    ->name('assets-detail.update');
    Route::delete('/{id}', [AssetsDetailsController::class,'destroy'])
    ->middleware(['permission:delete_assets'])
    ->name('assets-detail.destroy');
});
// Xử lý sửa chữa bảo dưỡng
Route::prefix('repair-fee')->middleware(['auth'])->group(function () {
    Route::get('/', [RepairCostController::class,'index'])
    ->middleware(['permission:view_assets'])
    ->name('assets-repair.index');
    Route::get('/{id}', [RepairCostController::class,'show'])
    ->middleware(['permission:view_assets'])
    ->name('assets-repair.show');
    Route::post('/', [RepairCostController::class,'store'])
    ->middleware(['permission:create_assets'])
    ->name('assets-repair.store');
    Route::put('/{id}', [RepairCostController::class,'update'])
    ->middleware(['permission:update_assets'])
    ->name('assets-repair.update');
    Route::delete('//{id}', [RepairCostController::class,'destroy'])
    ->middleware(['permission:delete_assets'])
    ->name('assets-repair.destroy');   
});

// Xử lý phiếu nhập
Route::prefix('receipt-note')->middleware(['auth'])->group(function () {
    Route::get('/', [ReceiptNoteController::class,'index'])
    ->middleware(['permission:view_assets'])
    ->name('receipt-note.index');
    Route::get('/{id}', [ReceiptNoteController::class,'show'])
    ->middleware(['permission:view_assets'])
    ->name('receipt-note.show');
    Route::post('/', [ReceiptNoteController::class,'store'])
    ->middleware(['permission:create_assets'])
    ->name('receipt-note.store');
    Route::put('/{id}', [ReceiptNoteController::class,'update'])
    ->middleware(['permission:update_assets'])
    ->name('receipt-note.update');
    Route::delete('//{id}', [ReceiptNoteController::class,'destroy'])
    ->middleware(['permission:delete_assets'])
    ->name('receipt-note.destroy');   
});
// Xử lý phiếu xuất
Route::prefix('delivery-note')->middleware(['auth'])->group(function () {
    Route::get('/', [DeliveryNoteController::class,'index'])
    ->middleware(['permission:view_assets'])
    ->name('delivery-note.index');
    Route::get('/{id}', [DeliveryNoteController::class,'show'])
    ->middleware(['permission:view_assets'])
    ->name('delivery-note.show');
    Route::post('/', [DeliveryNoteController::class,'store'])
    ->middleware(['permission:create_assets'])
    ->name('delivery-note.store');
    Route::put('/{id}', [DeliveryNoteController::class,'update'])
    ->middleware(['permission:update_assets'])
    ->name('delivery-note.update');
    Route::delete('//{id}', [DeliveryNoteController::class,'destroy'])
    ->middleware(['permission:delete_assets'])
    ->name('delivery-note.destroy');   
});
// Xử lý chi tiết phiếu nhập
Route::prefix('detail-receipt-note')->middleware(['auth'])->group(function () {
    Route::get('/', [DetailReceiptNoteController::class,'index'])
    ->middleware(['permission:view_assets'])
    ->name('detail-receipt-note.index');
    Route::get('/{id}', [DetailReceiptNoteController::class,'show'])
    ->middleware(['permission:view_assets'])
    ->name('detail-receipt-note.show');
    Route::post('/', [DetailReceiptNoteController::class,'store'])
    ->middleware(['permission:create_assets'])
    ->name('detail-receipt-note.store');
    Route::put('/{id}', [DetailReceiptNoteController::class,'update'])
    ->middleware(['permission:update_assets'])
    ->name('detail-receipt-note.update');
    Route::delete('//{id}', [DetailReceiptNoteController::class,'destroy'])
    ->middleware(['permission:delete_assets'])
    ->name('detail-receipt-note.destroy');   
});
// Xử lý chi tiết phiếu xuất
Route::prefix('detail-delivery-note')->middleware(['auth'])->group(function () {
    Route::get('/', [DetailDeliveryNoteController::class,'index'])
    ->middleware(['permission:view_assets'])
    ->name('detail-delivery-note.index');
    Route::get('/{id}', [DetailDeliveryNoteController::class,'show'])
    ->middleware(['permission:view_assets'])
    ->name('detail-delivery-note.show');
    Route::post('/', [DetailDeliveryNoteController::class,'store'])
    ->middleware(['permission:create_assets'])
    ->name('detail-delivery-note.store');
    Route::put('/{id}', [DetailDeliveryNoteController::class,'update'])
    ->middleware(['permission:update_assets'])
    ->name('detail-delivery-note.update');
    Route::delete('//{id}', [DetailDeliveryNoteController::class,'destroy'])
    ->middleware(['permission:delete_assets'])
    ->name('detail-delivery-note.destroy');   
});

Route::get('/get-department/{id}', [DepartmentController::class, 'getDepartments']);
Route::get('/get-user/{id}', [UserController::class, 'getUsers']);
Route::get('/get-assets/{id}', [AssetController::class, 'getAssets'])->name('getAssets');
Route::resource('/files-upload', FileUploadController::class);

// 

