<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('errors.404');
});
Route::get('/home', 'Web\HomeController@index')->name('home')->middleware('verified')->middleware('admin');
Auth::routes(['verify' => true]);

// route dashboard
Route::get('kasir/dashboard', 'Web\HomeController@kasir');
Route::get('admin/dashboard', 'Web\HomeController@admin')->name('admin.dashboard');
Route::get('staff/dashboard', 'Web\HomeController@staff');
Route::group(['namespace' => 'Web', 'middleware' => ['verified', 'admin']], function () {


    Route::post('user/create', 'UserController@store')->name('karyawan.store'); //menambah karyawan
    Route::post('user/update/{id}', 'UserController@update')->name('karyawan.update'); //menambah karyawan
    Route::get('userr/{id}', 'UserController@show')->name('karyawan.show'); //menambah karyawan
    Route::post('user/delete/{id}', 'UserController@destroy')->name('karyawan.destroy'); //menambah karyawan

    // Route User
    Route::get('user', 'UserController@index')->name('user.index');
    Route::get('product', 'ProductController@index')->name('product.index');
    Route::post('product', 'ProductController@store')->name('product.store');
    Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
    Route::get('product/delete/{id}', 'ProductController@destroy')->name('product.destroy');

    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::post('category', 'CategoryController@store')->name('category.store');
    Route::post('category/{id}', 'CategoryController@update')->name('category.update');
    Route::post('category/delete/{id}', 'CategoryController@destroy')->name('category.destroy');


    Route::get('supplier', 'SupplierController@index')->name('supplier.index');
    Route::post('supplier', 'SupplierController@store')->name('supplier.store');
    Route::post('supplier/{id}', 'SupplierController@update')->name('supplier.update');
    Route::post('supplier/delete/{id}', 'SupplierController@destroy')->name('supplier.destroy');

    Route::get('member', 'MemberController@index')->name('member.index');
    Route::post('member', 'MemberController@store')->name('member.store');
    Route::post('member/{id}', 'MemberController@update')->name('member.update');
    Route::post('member/delete/{id}', 'MemberController@destroy')->name('member.destroy');

    Route::get('keuangan', 'KeuanganController@index')->name('keuangan.index');

    // Route Pengeluaran
    Route::get('pengeluaran', 'PengeluaranController@index')->name('pengeluaran.index');
    Route::post('pengeluaran', 'PengeluaranController@store')->name('pengeluaran.store');

    Route::get('pembelian', 'PembelianController@index')->name('pembelian.index');
    Route::get('pembelianform', 'PembelianController@form')->name('pembelian.form');
    Route::post('pembelian', 'PembelianController@store')->name('pembelian.store');
    Route::post('pembelian/stir', 'PembelianController@stire')->name('pembelian.stire');
    Route::get('getpembelian', 'PembelianController@getData')->name('pembelian.get');
    Route::get('kulakan', 'PembelianController@getdataku')->name('kulakan.get');
    Route::post('pembelian/update', 'PembelianController@update')->name('pembelian.update');
    Route::post('pembelian/confirm', 'PembelianController@confirm')->name('pembelian.confirm');



    Route::get('penjualan', 'PenjualanController@index')->name('penjualan.index');
    Route::get('kasir', 'KasirController@index')->name('kasir.index');
    Route::get('getcart', 'KasirController@getData')->name('cart.get');
    Route::get('getpenjualan', 'KasirController@getdataku')->name('penjualan.get');
    Route::post('penjualan/store', 'KasirController@store')->name('penjualan.store');
    Route::post('penjualan/stir', 'KasirController@stire')->name('penjualan.stire');
    Route::post('penjualan/confirm', 'KasirController@confirm')->name('penjualan.confirm');


    Route::get('blacklist', 'UserController@blacklist')->name('blacklist.index');

    Route::get('cart-form', 'CartController@create');
    Route::post('cart-form', 'CartController@store')->name('cart-form');
    Route::post('beli-form/{id}', 'CartController@beli')->name('beli-form');

    Route::post('absensi', 'AbsenController@checkin')->name('kehadiran.check-in');
    Route::post('absen', 'AbsenController@checkout')->name('kehadiran.check-out');
});
Route::get('/users', 'AjaxController@index');
Route::get('/getData/', 'AjaxController@getData');
