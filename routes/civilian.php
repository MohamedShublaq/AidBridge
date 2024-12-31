<?php

use App\Http\Controllers\Civilian\AidController;
use App\Http\Controllers\Civilian\HomeController;
use App\Http\Controllers\Civilian\NgoController;
use App\Http\Controllers\Civilian\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Civilian Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>['auth:web' , 'completePersonalInfo'], 'prefix'=>'civilian', 'as'=>'civilian.'] , function(){

    //*********************// Home Controller //*********************//
    Route::controller(HomeController::class)->group(function(){
        Route::get('/home' , 'index')->name('home');
        Route::post('/apply' , 'apply')->name('apply');
    });

    //*********************// Profile Controller //*********************//
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile' , 'showProfile')->name('showProfile')->withoutMiddleware('completePersonalInfo');
        Route::post('/profile' , 'updateProfile')->name('updateProfile')->withoutMiddleware('completePersonalInfo');
        Route::get('/change/password' , 'showChangePassword')->name('showChangePassword');
        Route::post('/change/password' , 'changePassword')->name('changePassword');
    });

    //*********************// Ngo Controller //*********************//
    Route::controller(NgoController::class)->as('ngos.')->group(function(){
        Route::get('/ngos/status/{status}' , 'index')->name('index');
    });

    //*********************// Aid Controller //*********************//
    Route::controller(AidController::class)->as('aids.')->group(function(){
        Route::get('/aid/show/{id}' , 'show')->name('show');
        Route::post('/aid/response' , 'response')->name('response');
        Route::get('/aid/showDistribution/{id}' , 'showDistribution')->name('showDistribution');
    });
});