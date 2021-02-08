<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/email/resend', 'Api\VerificationController@resend')->name('verification.resend'); //kirim email verivikasi
Route::get('/email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify'); //kirim email verivikasi

//route reset password
Route::post('password/email', 'Api\ForgotPasswordController@forgot'); //mengirim email reset password
Route::post('password/reset', 'Api\ForgotPasswordController@reset');


Route::group(['namespace' => 'Api'], function () {
    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@login');
});

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify']], function () {
    Route::get('bookall', 'BookController@bookAuth')->middleware('jwt.verify');
});
