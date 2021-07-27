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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', function () {
    return view('pages.Dashboard');
})->name('dashboard');

Route::get('index', function () {
    return view('pages.Dashboard2');
})->name('dashboard2');

Route::get('index2', function () {
    return view('pages.Dashboard3');
})->name('dashboard3');

Route::get('Widgets', function () {
    return view('pages.Widgets');
})->name('Widgets');

Route::get('Tables/simple', function () {
    return view('Tables.Simple_table');
})->name('Simple_table');

Route::get('Tables/data', function () {
    return view('Tables.Data_table');
})->name('Data_table');


Route::get('Calendar', function () {
    return view('pages.Calendar');
})->name('Calendar');

Route::get('Gallery', function () {
    return view('pages.Gallery');
})->name('Gallery');

Route::get('Mail/inbox', function () {
    return view('Mailbox.Inbox');
})->name('Inbox');
Route::get('Mail/compose', function () {
    return view('Mailbox.Compose');
})->name('Compose');
Route::get('Mail/read', function () {
    return view('Mailbox.Read');
})->name('Read');