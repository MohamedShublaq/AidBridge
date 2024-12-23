<?php

use App\Http\Controllers\Donor\HomeController;
use App\Http\Controllers\Donor\NgoController;
use App\Http\Controllers\Donor\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Donor Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>['auth:donor'], 'prefix'=>'donor', 'as'=>'donor.'] , function(){

    //*********************// Home Controller //*********************//
    Route::controller(HomeController::class)->group(function(){
        Route::get('/home' , 'index')->name('home');
        Route::post('/apply' , 'apply')->name('apply');
    });

    //*********************// Profile Controller //*********************//
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile' , 'showProfile')->name('showProfile');
        Route::post('/profile' , 'updateProfile')->name('updateProfile');
        Route::get('/change/password' , 'showChangePassword')->name('showChangePassword');
        Route::post('/change/password' , 'changePassword')->name('changePassword');
    });

    //*********************// Ngo Controller //*********************//
    Route::controller(NgoController::class)->as('ngos.')->group(function(){
        Route::get('/ngos/status/{status}' , 'index')->name('index');
    });
});