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
Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');
Route::post('registermember', 'Api\UserController@register_member');

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    // Route staff
    Route::get('category', 'CategoryController@index'); // melihat semua category
    Route::post('category', 'CategoryController@store'); // input category baru
    Route::post('category/{id}', 'CategoryController@update'); // update category
    Route::post('category/delete/{id}', 'CategoryController@destroy'); // hapus category

    Route::get('product', 'ProductController@index'); // melihat semua supplier
    Route::post('product', 'ProductController@store'); // input supplier baru
    Route::post('product/{id}', 'ProductController@update'); // update supplier
    Route::post('product/delete/{id}', 'ProductController@destroy'); // hapus supplier

    Route::get('supplier', 'SupplierController@index'); // melihat semua product
    Route::post('supplier', 'SupplierController@store'); // input barang baru
    Route::post('supplier/{id}', 'SupplierController@update'); // update barang
    Route::post('supplier/delete/{id}', 'SupplierController@destroy'); // hapus barang

    Route::get('pembelian', 'PembelianController@index'); // melihat semua pembelian
    Route::post('pembelian/confirm', 'PembelianController@confirm'); // input pembelian
    Route::post('pembelian/{barcode}', 'PembelianController@store'); // input pembelian
    Route::post('pembelian/destroy/{id}', 'PembelianController@destroy'); // input pembelian
    Route::post('pembelian/update/{id}', 'PembelianController@update'); // input pembelian

    //  Route kasir
    Route::get('penjualan', 'PenjualanController@index'); // melihat semua penjualan
    Route::post('penjualan/bayar', 'PenjualanController@bayar'); // input hasil jualan
    Route::post('penjualan/{barcode}', 'PenjualanController@store'); // input hasil jualan
    Route::post('penjualan/update/{id}', 'PenjualanController@update'); // input hasil jualan
    Route::post('penjualan/diskon', 'PenjualanController@diskon'); // input hasil jualan
    Route::post('penjualan/confirm', 'PenjualanController@confirm'); // input hasil jualan
    Route::post('penjualan/destroy/{id}', 'PenjualanController@destroy'); // input hasil jualan

    // Route pimpinan
    Route::get('keuangan', 'KeuanganController@index'); // melihat semua transaksi keluar masuk uang

    Route::get('member', 'MemberController@index'); // melihat semua member
    Route::post('member', 'MemberController@store'); // membuat member baru
    Route::post('member/{id}', 'MemberController@update'); // mengupdate member berdasarkan id
    Route::post('member/delete/{id}', 'MemberController@destroy'); // menghapus member berdasarkan id
    Route::post('member/update', 'MemberController@updateme'); // mengupdate data diri sendiri

    Route::get('pengeluaran', 'PengeluaranController@index'); // melihat semua pengeluaran
    Route::post('pengeluaran', 'PengeluaranController@store'); // menginput pengluaran

    // Route member
    Route::get('user', 'UserController@index'); // melihat data diri

    // Route admin

});



Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
});
