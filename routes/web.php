<?php

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

Route::fallback(function () {
    return view('errors.404');
});
Route::get('/home', 'Web\HomeController@index')->name('home')->middleware('verified')->middleware('admin');
Auth::routes(['verify' => true]);

// route dashboard
Route::get('admin/dashboard', 'Web\HomeController@admin')->middleware('verified')->middleware('admin')->name('admin.dashboard');
Route::get('kasir/dashboard', 'Web\HomeController@kasir')->middleware('verified')->middleware('admin');
Route::get('staff/dashboard', 'Web\HomeController@staff')->middleware('verified')->middleware('admin');

Route::post('user/create', 'Web\UserController@store')->middleware('verified')->middleware('admin')->name('karyawan.store'); //menambah karyawan
Route::post('user/update/{id}', 'Web\UserController@update')->middleware('verified')->middleware('admin')->name('karyawan.update'); //menambah karyawan
Route::get('userr/{id}', 'Web\UserController@show')->middleware('verified')->middleware('admin')->name('karyawan.show'); //menambah karyawan
Route::post('user/delete/{id}', 'Web\UserController@destroy')->middleware('verified')->middleware('admin')->name('karyawan.destroy'); //menambah karyawan

// Route User
Route::get('user', 'Web\UserController@index')->middleware('verified')->middleware('admin')->name('user.index');
Route::get('product', 'Web\ProductController@index')->middleware('verified')->middleware('admin')->name('product.index');
Route::post('product', 'Web\ProductController@store')->middleware('verified')->middleware('admin')->name('product.store');
Route::get('product/update/{id}', 'Web\ProductController@update')->middleware('verified')->middleware('admin')->name('product.update');
Route::get('product/delete/{id}', 'Web\ProductController@destroy')->middleware('verified')->middleware('admin')->name('product.destroy');

Route::get('category', 'Web\CategoryController@index')->middleware('verified')->middleware('admin')->name('category.index');
Route::post('category', 'Web\CategoryController@store')->middleware('verified')->middleware('admin')->name('category.store');
Route::post('category/{id}', 'Web\CategoryController@update')->middleware('verified')->middleware('admin')->name('category.update');
Route::post('category/delete/{id}', 'Web\CategoryController@destroy')->middleware('verified')->middleware('admin')->name('category.destroy');


Route::get('supplier', 'Web\SupplierController@index')->middleware('verified')->middleware('admin')->name('supplier.index');
Route::post('supplier', 'Web\SupplierController@store')->middleware('verified')->middleware('admin')->name('supplier.store');
Route::post('supplier/{id}', 'Web\SupplierController@update')->middleware('verified')->middleware('admin')->name('supplier.update');
Route::post('supplier/delete/{id}', 'Web\SupplierController@destroy')->middleware('verified')->middleware('admin')->name('supplier.destroy');

Route::get('member', 'Web\MemberController@index')->middleware('verified')->middleware('admin')->name('member.index');
Route::post('member', 'Web\MemberController@store')->middleware('verified')->middleware('admin')->name('member.store');
Route::post('member/{id}', 'Web\MemberController@update')->middleware('verified')->middleware('admin')->name('member.update');
Route::post('member/delete/{id}', 'Web\MemberController@destroy')->middleware('verified')->middleware('admin')->name('member.destroy');

Route::get('keuangan', 'Web\KeuanganController@index')->middleware('verified')->middleware('admin')->name('keuangan.index');

// Route Pengeluaran
Route::get('pengeluaran', 'Web\PengeluaranController@index')->middleware('verified')->middleware('admin')->name('pengeluaran.index');
Route::post('pengeluaran', 'Web\PengeluaranController@store')->middleware('verified')->middleware('admin')->name('pengeluaran.store');

Route::get('pembelian', 'Web\PembelianController@index')->middleware('verified')->middleware('admin')->name('pembelian.index');
Route::get('pembelianform', 'Web\PembelianController@form')->middleware('verified')->middleware('admin')->name('pembelian.form');
Route::post('pembelian', 'Web\PembelianController@store')->middleware('verified')->middleware('admin')->name('pembelian.store');
Route::post('pembelian/stir', 'Web\PembelianController@stire')->middleware('verified')->middleware('admin')->name('pembelian.stire');
Route::get('getpembelian', 'Web\PembelianController@getData')->middleware('verified')->middleware('admin')->name('pembelian.get');
Route::get('kulakan', 'Web\PembelianController@getdataku')->middleware('verified')->middleware('admin')->name('kulakan.get');
Route::post('pembelian/update', 'Web\PembelianController@update')->middleware('verified')->middleware('admin')->name('pembelian.update');
Route::post('pembelian/confirm', 'Web\PembelianController@confirm')->middleware('verified')->middleware('admin')->name('pembelian.confirm');



Route::get('penjualan', 'Web\PenjualanController@index')->middleware('verified')->middleware('admin')->name('penjualan.index');
Route::get('kasir', 'Web\KasirController@index')->middleware('verified')->middleware('admin')->name('kasir.index');
Route::get('getcart', 'Web\KasirController@getData')->middleware('verified')->middleware('admin')->name('cart.get');
Route::get('getpenjualan', 'Web\KasirController@getdataku')->middleware('verified')->middleware('admin')->name('penjualan.get');
Route::post('penjualan/store', 'Web\KasirController@store')->middleware('verified')->middleware('admin')->name('penjualan.store');
Route::post('penjualan/stir', 'Web\KasirController@stire')->middleware('verified')->middleware('admin')->name('penjualan.stire');
Route::post('penjualan/confirm', 'Web\KasirController@confirm')->middleware('verified')->middleware('admin')->name('penjualan.confirm');






Route::get('blacklist', 'Web\UserController@blacklist')->middleware('verified')->middleware('admin')->name('blacklist.index');

// Route::livewire('admin/product', App\Http\Livewire\Kasir\Create::class)->name('admin.product')->middleware('auth');
Route::get('cart-form', 'Web\CartController@create');
Route::post('cart-form', 'Web\CartController@store')->name('cart-form');
Route::post('beli-form/{id}', 'Web\CartController@beli')->name('beli-form');

Route::get('/users', 'AjaxController@index');
Route::get('/getData/', 'AjaxController@getData');
