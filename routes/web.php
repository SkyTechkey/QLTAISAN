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

Route::get('/', function () {
    return view('pages.home.dashboardv3');
});

Route::get('/dashboardv3', function () {
    return view('pages.home.dashboardv3');
});

Route::get('/charts/chartjs', function () {
    return view('pages.charts.chartjs');
});
Route::get('/charts/flot', function () {
    return view('pages.charts.flot');
});
Route::get('/charts/inline', function () {
    return view('pages.charts.inline');
});

Route::get('/charts/uplot', function () {
    return view('pages.charts.uplot');
});

Route::get('/form/advanced', function () {
    return view('pages.form.advanced');
});

Route::get('/form/editors', function () {
    return view('pages.form.editors');
});

Route::get('/form/general', function () {
    return view('pages.form.general');
});

Route::get('/form/validation', function () {
    return view('pages.form.validation');
});

Route::get('/mailbox/compose', function () {
    return view('pages.mailbox.compose');
});

Route::get('/mailbox/mailbox', function () {
    return view('pages.mailbox.mailbox');
});

Route::get('/mailbox/read-mail', function () {
    return view('pages.mailbox.read-mail');
});

Route::get('/tables/data', function () {
    return view('pages.tables.data');
});

Route::get('/tables/jsgrid', function () {
    return view('pages.tables.jsgrid');
});

Route::get('/tables/simple', function () {
    return view('pages.tables.simple');
});
