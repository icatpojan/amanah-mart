<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('errors.404');
});
Route::get('/home', 'Web\HomeController@index')->name('home');
Auth::routes(['verify' => true]);
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');

// route dashboard
Route::get('forbiden', 'Web\HomeController@forbiden');
Route::group(['namespace' => 'Web', 'middleware' => ['verified']], function () {
    Route::get('dashboard', 'HomeController@admin')->name('admin.dashboard');
    Route::group(['middleware' => ['admin']], function () {
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
        Route::get('keuangan/cetak_pdf', 'KeuanganController@cetak_pdf')->name('cetak.keuangan');
        Route::post('perwaktu', 'KeuanganController@getdata')->name('get.keuangan');


        // Route Pengeluaran
        Route::get('pengeluaran', 'PengeluaranController@index')->name('pengeluaran.index');
        Route::post('pengeluaran', 'PengeluaranController@store')->name('pengeluaran.store');

        Route::get('pembelian', 'PembelianController@index')->name('pembelian.index');
        Route::post('pembelian', 'PembelianController@store')->name('pembelian.store');
        Route::post('pembelian/diskon', 'PembelianController@diskon')->name('pembelian.diskon');
        Route::get('getpembelian', 'PembelianController@getData')->name('pembelian.get');
        Route::get('kulakan', 'PembelianController@getdataku')->name('kulakan.get');
        Route::post('pembelian/confirm', 'PembelianController@confirm')->name('pembelian.confirm');
        Route::get('pembelianform', 'PembelianController@form')->name('pembelian.form');
        Route::post('pembelian/update/{id}', 'PembelianController@update')->name('pembelian.update');
        Route::post('pembelian/delete/{id}', 'PembelianController@destroy')->name('pembelian.destroy');
        Route::get('kembali', 'PembelianController@kembali')->name('pembelian.kembali');
        Route::get('pembelian/show/{id}', 'PembelianController@show')->name('pembelian.show');


        Route::get('penjualan', 'PenjualanController@index')->name('penjualan.index');
        Route::get('kasir', 'KasirController@index')->name('kasir.index');
        Route::get('penjualan/cetak_pdf', 'PenjualanController@cetak_pdf')->name('cetak.penjualan');
        Route::post('penjualan/bayar', 'KasirController@bayar')->name('penjualan.bayar');
        Route::post('penjualan/store', 'KasirController@store')->name('penjualan.store');
        Route::post('penjualan/diskon', 'KasirController@diskon')->name('penjualan.diskon');
        Route::post('penjualan/confirm', 'KasirController@confirm')->name('penjualan.confirm');
        Route::post('penjualan/confirm-saldo', 'KasirController@confirm_saldo')->name('penjualan.confirm-saldo');
        Route::post('penjualan/update/{id}', 'KasirController@update')->name('penjualan.update');
        Route::post('penjualan/delete/{id}', 'KasirController@destroy')->name('penjualan.destroy');
        Route::get('penjualan/show/{id}', 'PenjualanController@show')->name('penjualan.show');
        Route::post('penjualan/cetak_pdf', 'KasirController@cetak_pdf')->name('penjualan.cetak');


        Route::get('blacklist', 'UserController@blacklist')->name('blacklist.index');

        Route::get('cart-form', 'CartController@create');
        Route::post('cart-form', 'CartController@store')->name('cart-form');
        Route::post('beli-form/{id}', 'CartController@beli')->name('beli-form');

        Route::post('absensi', 'AbsenController@checkin')->name('kehadiran.check-in');
        Route::post('absen', 'AbsenController@checkout')->name('kehadiran.check-out');
    });

    Route::post('member/update/{id}', 'MemberController@updateme')->name('member.updateme');

});
Route::get('/users', 'AjaxController@index');
Route::get('/getData/', 'AjaxController@getData');
