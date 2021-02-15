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

Route::get('/home', 'Web\HomeController@index')->name('home')->middleware('verified')->middleware('role');
Auth::routes(['verify' => true]);

// route dashboard
Route::get('admin/dashboard', 'Web\HomeController@admin')->middleware('verified')->middleware('role');
Route::get('kasir/dashboard', 'Web\HomeController@kasir')->middleware('verified')->middleware('role');
Route::get('staff/dashboard', 'Web\HomeController@staff')->middleware('verified')->middleware('role');

Route::post('user/create', 'Web\UserController@store')->middleware('verified')->middleware('role')->name('karyawan.store'); //menambah karyawan
Route::post('user/update/{id}', 'Web\UserController@update')->middleware('verified')->middleware('role')->name('karyawan.update'); //menambah karyawan
Route::get('userr/{id}', 'Web\UserController@show')->middleware('verified')->middleware('role')->name('karyawan.show'); //menambah karyawan
Route::post('user/delete/{id}', 'Web\UserController@destroy')->middleware('verified')->middleware('role')->name('karyawan.destroy'); //menambah karyawan

// Route User
Route::get('user', 'Web\UserController@index')->middleware('verified')->middleware('role')->name('user.index');
Route::get('product', 'Web\ProductController@index')->middleware('verified')->middleware('role')->name('product.index');

Route::get('category', 'Web\CategoryController@index')->middleware('verified')->middleware('role')->name('category.index');
Route::post('category', 'Web\CategoryController@store')->middleware('verified')->middleware('role')->name('category.store');
Route::post('category/{id}', 'Web\CategoryController@update')->middleware('verified')->middleware('role')->name('category.update');
Route::post('category/delete/{id}', 'Web\CategoryController@destroy')->middleware('verified')->middleware('role')->name('category.destroy');


Route::get('supplier', 'Web\SupplierController@index')->middleware('verified')->middleware('role')->name('supplier.index');
Route::post('supplier', 'Web\SupplierController@store')->middleware('verified')->middleware('role')->name('supplier.store');
Route::post('supplier/{id}', 'Web\SupplierController@update')->middleware('verified')->middleware('role')->name('supplier.update');
Route::post('supplier/delete/{id}', 'Web\SupplierController@destroy')->middleware('verified')->middleware('role')->name('supplier.destroy');

Route::get('member', 'Web\MemberController@index')->middleware('verified')->middleware('role')->name('member.index');
Route::post('member', 'Web\MemberController@store')->middleware('verified')->middleware('role')->name('member.store');
Route::post('member/{id}', 'Web\MemberController@update')->middleware('verified')->middleware('role')->name('member.update');
Route::post('member/delete/{id}', 'Web\MemberController@destroy')->middleware('verified')->middleware('role')->name('member.destroy');

Route::get('keuangan', 'Web\KeuanganController@index')->middleware('verified')->middleware('role')->name('keuangan.index');

// Route Pengeluaran
Route::get('pengeluaran', 'Web\PengeluaranController@index')->middleware('verified')->middleware('role')->name('pengeluaran.index');
Route::post('pengeluaran', 'Web\PengeluaranController@store')->middleware('verified')->middleware('role')->name('pengeluaran.store');

Route::get('pembelian', 'Web\PembelianController@index')->middleware('verified')->middleware('role')->name('pembelian.index');
Route::get('penjualan', 'Web\PenjualanController@index')->middleware('verified')->middleware('role')->name('penjualan.index');
Route::get('kasir', 'Web\KasirController@index')->middleware('verified')->middleware('role')->name('kasir.index');

Route::get('blacklist', 'Web\UserController@blacklist')->middleware('verified')->middleware('role')->name('blacklist.index');

// Route::livewire('admin/product', App\Http\Livewire\Kasir\Create::class)->name('admin.product')->middleware('auth');
Route::get('ajax-request', 'AjaxController@create');
Route::post('ajax-request', 'AjaxController@store');
