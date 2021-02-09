<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/email/resend', 'Api\VerificationController@resend')->name('verification.resend'); //kirim email verivikasi
Route::get('/email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify'); //kirim email verivikasi

// Route reset password
Route::post('password/email', 'Api\ForgotPasswordController@forgot'); //mengirim email reset password
Route::post('password/reset', 'Api\ForgotPasswordController@reset');


// Route auth
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    // Route staff
    Route::get('category', 'CategoryController@index'); // melihat semua category
    Route::post('category', 'CategoryController@store'); // input category baru

    Route::get('product', 'ProductController@index'); // melihat semua product
    Route::post('product', 'ProductController@store'); // input barang baru

    Route::post('product/{id}', 'ProductController@update'); // update barang
    Route::get('pembelian', 'PembelianController@index'); // melihat semua pembelian
    Route::post('pembelian', 'PembelianController@store'); // input laporan pembelian

    //  Route kasir
    Route::get('Penjualan', 'PenjualanController@index'); // melihat semua penjualan
    Route::post('Penjualan', 'PenjualanController@store'); // input hasil jualan

    // Route pimpinan
    Route::get('Keuangan', 'KeuanganController@index'); // melihat semua transaksi keluar masuk uang

    Route::get('member', 'MemberController@index'); // melihat semua member
    Route::post('member', 'MemberController@store'); // membuat member baru
    Route::post('member/{id}', 'MemberController@update'); // mengupdate member berdasarkan id

    Route::get('pengeluaran', 'PengeluaranController@index'); // melihat semua pengeluaran
    Route::post('pengeluaran', 'PengeluaranController@store'); // menginput pengluaran

    // Route member
    Route::get('user', 'UserController@index'); // melihat data diri

    // Route admin

});



Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
});
