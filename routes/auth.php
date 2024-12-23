<?php

use App\Http\Controllers\Auth\CivilianRegisterController;
use App\Http\Controllers\Auth\ForgetPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

//*********************// Login Controller //*********************//
Route::controller(LoginController::class)->group(function(){
    Route::get('/login/{type}' , 'showLogin')->name('showLogin');
    Route::post('/login' , 'login')->name('login');
    Route::post('/logout' , 'logout')->name('logout');
});

//*********************// CivilianRegister Controller //*********************//
Route::controller(CivilianRegisterController::class)->group(function(){
    Route::get('/register' , 'showRegister')->name('showRegister');
    Route::post('/register' , 'register')->name('register');
});

//*********************// ForgetPassword Controller //*********************//
Route::controller(ForgetPasswordController::class)->group(function(){
    Route::get('enter/{type}/email' , 'showEnterEmail')->name('showEnterEmail');
    Route::post('enter/email' , 'sendOtp')->name('sendOtp');
    Route::get('enter/otp/{email}/{type}' , 'showEnterOtp')->name('showEnterOtp');
    Route::post('enter/otp' , 'checkOtp')->name('checkOtp');
});

//*********************// ResetPassword Controller //*********************//
Route::controller(ResetPasswordController::class)->group(function(){
    Route::get('reset/password/{email}/{type}' , 'showResetPassword')->name('showResetPassword');
    Route::post('reset/password' , 'resetPassword')->name('resetPassword');
});