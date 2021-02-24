<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('cobalah', 'CobaController@coba');
Route::get('/email/resend', 'Api\VerificationController@resend')->name('verification.resend'); //kirim email verivikasi
Route::get('/email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify'); //kirim email verivikasi

// Route reset password
Route::post('password/email', 'Api\ForgotPasswordController@forgot'); //mengirim email reset password
Route::post('password/reset', 'Api\ForgotPasswordController@reset');


// Route auth
Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');
Route::post('registermember', 'Api\MemberController@register_member');

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    // Route CRUD category
    Route::get('category', 'CategoryController@index'); // melihat semua category
    Route::post('category', 'CategoryController@store'); // input category baru
    Route::post('category/{id}', 'CategoryController@update'); // update category
    Route::post('category/delete/{id}', 'CategoryController@destroy'); // hapus category

    // Route CRUD product
    Route::get('product', 'ProductController@index'); // melihat semua supplier
    Route::post('product', 'ProductController@store'); // input supplier baru
    Route::post('product/{id}', 'ProductController@update'); // update supplier
    Route::post('product/delete/{id}', 'ProductController@destroy'); // hapus supplier

    // Route CRUD supplier
    Route::get('supplier', 'SupplierController@index'); // melihat semua product
    Route::post('supplier', 'SupplierController@store'); // input barang baru
    Route::post('supplier/{id}', 'SupplierController@update'); // update barang
    Route::post('supplier/delete/{id}', 'SupplierController@destroy'); // hapus barang

    // Route CRUD pembelian atau kulakan
    Route::get('pembelian', 'PembelianController@index'); // melihat semua pembelian
    Route::post('pembelian/confirm', 'PembelianController@confirm'); // input pembelian
    Route::post('pembelian/{barcode}', 'PembelianController@store'); // input pembelian
    Route::post('pembelian/destroy/{id}', 'PembelianController@destroy'); // input pembelian
    Route::post('pembelian/update/{id}', 'PembelianController@update'); // input pembelian

    // Route CRUD penjualan dan kasir
    Route::get('penjualan', 'PenjualanController@index'); // melihat semua penjualan
    Route::post('penjualan/bayar', 'PenjualanController@bayar'); // input hasil jualan
    Route::post('penjualan/diskon', 'PenjualanController@diskon'); // input hasil jualan
    Route::post('penjualan/confirm', 'PenjualanController@confirm'); // input hasil jualan
    Route::post('penjualan/confirmsaldo', 'PenjualanController@confirm_saldo'); // input hasil jualan dengan saldo
    Route::post('penjualan/{barcode}', 'PenjualanController@store'); // input hasil jualan
    Route::post('penjualan/update/{id}', 'PenjualanController@update'); // input hasil jualan
    Route::post('penjualan/destroy/{id}', 'PenjualanController@destroy'); // input hasil jualan

    // Route Read laporan dan keuangan
    Route::get('keuangan', 'KeuanganController@index'); // melihat semua transaksi keluar masuk uang
    Route::get('laporan', 'LaporanController@index'); // melihat semua laporan keluar masuk uang dalam 1 bulan
    Route::get('harian', 'LaporanController@indexharian'); // melihat semua laporan keluar masuk uang dalam 1 bulan
    Route::post('perwaktu/{awal}/{akhir}', 'LaporanController@getdata'); // melihat semua laporan keluar masuk uang dalam 1 bulan

    // Route CRUD member oleh member dan karyawan
    Route::get('member', 'MemberController@index'); // melihat semua member oleh karyawan
    Route::get('me', 'MemberController@me'); // melihat data diri sendiri oleh member
    Route::post('member/update', 'MemberController@updateme'); // mengupdate data diri sendiri

    Route::post('member', 'KaryawanController@store'); // membuat member baru oleh pengurus
    Route::post('member/{id}', 'MemberController@update'); // mengupdate member berdasarkan id oleh karyawan

    Route::post('member/delete/{id}', 'MemberController@destroy'); // menghapus member berdasarkan id
    Route::post('member/topup/{id}', 'MemberController@topup'); //  member top up berdasarkan id

    // Route CRUD pengeluaran
    Route::get('pengeluaran', 'PengeluaranController@index'); // melihat semua pengeluaran
    Route::post('pengeluaran', 'PengeluaranController@store'); // menginput pengluaran

    // Route CR absen
    Route::post('checkin', 'AbsenController@checkin'); // absen masuk
    Route::post('checkout', 'AbsenController@checkout'); // absen keluar
    Route::get('absen', 'AbsenController@index'); // mengambil data absen semua
    Route::get('absen/{id}', 'AbsenController@show'); // absen sesuai id

    // Route CRUD karyawan
    Route::get('user', 'KaryawanController@user'); // melihat semua user karyawan
    Route::get('karyawanAll', 'KaryawanController@karyawan'); // melihat semua karyawan
    Route::get('karyawan', 'KaryawanController@index'); // melihat data diri oleh karyawan
    Route::get('karyawan/{id}', 'KaryawanController@show'); // melihat data diri oleh karyawan
    Route::post('karyawan/update', 'KaryawanController@updateme'); // update data diri sendiri
    Route::post('karyawan/update/{id}', 'KaryawanController@update'); // update data orang
});
