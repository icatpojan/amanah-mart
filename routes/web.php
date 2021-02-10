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

// Route User
Route::get('user', 'Web\UserController@index')->middleware('verified')->middleware('role')->name('user.index');
Route::get('product', 'Web\ProductController@index')->middleware('verified')->middleware('role')->name('product.index');
Route::get('category', 'Web\CategoryController@index')->middleware('verified')->middleware('role')->name('category.index');
Route::get('supplier', 'Web\SupplierController@index')->middleware('verified')->middleware('role')->name('supplier.index');

Route::get('member', 'Web\MemberController@index')->middleware('verified')->middleware('role')->name('member.index');
Route::get('keuangan', 'Web\KeuanganController@index')->middleware('verified')->middleware('role')->name('keuangan.index');
Route::get('pengeluaran', 'Web\PengeluaranController@index')->middleware('verified')->middleware('role')->name('pengeluaran.index');
Route::get('pembelian', 'Web\PembelianController@index')->middleware('verified')->middleware('role')->name('pembelian.index');
Route::get('penjualan', 'Web\PenjualanController@index')->middleware('verified')->middleware('role')->name('penjualan.index');
