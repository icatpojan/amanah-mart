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
    return view('welcome');
});

Route::get('/home', 'Web\HomeController@index') ->name('home')->middleware('verified')->middleware('role');
Auth::routes(['verify' => true]);

// route dashboard
Route::get('admin/dashboard', 'Web\HomeController@admin')->middleware('verified')->middleware('role');
Route::get('kasir/dashboard', 'Web\HomeController@kasir')->middleware('verified')->middleware('role');
Route::get('staff/dashboard', 'Web\HomeController@staff')->middleware('verified')->middleware('role');
