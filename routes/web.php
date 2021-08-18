<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
// Route::get('/login',function(){
//     if(Auth::attempt(['email'=>'user@gmail.com','password'=>'123456'])){
//        return redirect()->route('user.index');
//         // dd(Auth::check());
//     }
// });
Route::resource('user',UserController::class);
Route::prefix('user')->middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class,'index'])->middleware(['permission:view_user'])->name('user.index');
    Route::get('/{id}', [UserController::class,'show'])->middleware(['permission:view_user'])->name('user.show');
    Route::get('/create', [UserController::class,'create'])->middleware(['permission:create_user'])->name('user.create');
    Route::post('/', [UserController::class,'store'])->middleware(['permission:create_user'])->name('user.store');
    Route::get('/{id}/edit', [UserController::class,'edit'])->middleware(['permission:update_user'])->name('user.update');
    Route::put('/{id}', [UserController::class,'update'])->middleware(['permission:update_user'])->name('user.update');
    Route::delete('/{id}', [UserController::class,'destroy'])->middleware(['permission:delete_user'])->name('user.destroy');
});