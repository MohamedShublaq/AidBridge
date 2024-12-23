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

Route::group(['middleware'=>['auth:web'], 'prefix'=>'civilian', 'as'=>'civilian.'] , function(){

    //*********************// Home Controller //*********************//
    Route::controller(HomeController::class)->group(function(){
        Route::get('/home' , 'index')->name('home')->middleware('completePersonalInfo');
        Route::post('/apply' , 'apply')->name('apply')->middleware('completePersonalInfo');
    });

    //*********************// Profile Controller //*********************//
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile' , 'showProfile')->name('showProfile');
        Route::post('/profile' , 'updateProfile')->name('updateProfile');
        Route::get('/change/password' , 'showChangePassword')->name('showChangePassword')->middleware('completePersonalInfo');
        Route::post('/change/password' , 'changePassword')->name('changePassword')->middleware('completePersonalInfo');
    });

    //*********************// Ngo Controller //*********************//
    Route::controller(NgoController::class)->as('ngos.')->group(function(){
        Route::get('/ngos/status/{status}' , 'index')->name('index')->middleware('completePersonalInfo');
    });

    //*********************// Aid Controller //*********************//
    Route::controller(AidController::class)->as('aids.')->group(function(){
        Route::get('/aid/show/{id}' , 'show')->name('show')->middleware('completePersonalInfo');
        Route::post('/aid/response' , 'response')->name('response')->middleware('completePersonalInfo');
        Route::get('/aid/showDistribution/{id}' , 'showDistribution')->name('showDistribution')->middleware('completePersonalInfo');
    });
    //Dont forget to add completePersonalInfo middleware to new routes
});