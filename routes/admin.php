<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorizationController;
use App\Http\Controllers\Admin\CivilianController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DeletionResponseController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NgoController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>['auth:admin'], 'prefix'=>'admin', 'as'=>'admin.'] , function(){

    //*********************// Home Controller //*********************//
    Route::get('/home' , [HomeController::class,'index'])->name('home');

    //*********************// Profile Controller //*********************//
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile' , 'showProfile')->name('showProfile');
        Route::post('/profile' , 'updateProfile')->name('updateProfile');
        Route::get('/change/password' , 'showChangePassword')->name('showChangePassword');
        Route::post('/change/password' , 'changePassword')->name('changePassword');
    });

    //*********************// Authoriztion Controller //*********************//
    Route::resource('authorizations' , AuthorizationController::class)->except('show');

    //*********************// Admin Controller //*********************//
    Route::resource('admins' , AdminController::class)->except('show');

    //*********************// Civilian Controller //*********************//
    Route::resource('civilians' , CivilianController::class)->only(['index','show','destroy']);

    //*********************// Ngo Controller //*********************//
    Route::resource('ngos' , NgoController::class)->except(['edit','update']);
    Route::controller(NgoController::class)->as('ngos.')->group(function(){
        Route::get('/ngo/{id}/civilians' , 'showCivilians')->name('showCivilians');
        Route::get('/ngo/{id}/donors' , 'showDonors')->name('showDonors');
        Route::get('/ngo/{id}/providers' , 'showProviders')->name('showProviders');
        Route::get('/ngo/{id}/aids' , 'showAids')->name('showAids');
        Route::delete('/aid/delete' , 'deleteAid')->name('deleteAid');
    });

    //*********************// Donor Controller //*********************//
    Route::resource('donors' , DonorController::class)->except(['edit','update']);

    //*********************// Provider Controller //*********************//
    Route::resource('providers' , ProviderController::class)->only(['index','destroy']);

    //*********************// Contact Controller //*********************//
    Route::resource('contacts' , ContactController::class)->only(['index','show','destroy']);

    //*********************// DeletionResponse Controller //*********************//
    Route::controller(DeletionResponseController::class)->group(function(){
        Route::post('response/deletion' , 'response')->name('responseDeletion');
        Route::get('response/deletion/{id}' , 'showResponses')->name('showResponses');
    });

    //*********************// Setting Controller //*********************//
    Route::controller(SettingController::class)->prefix('setting/')->group(function(){
        Route::get('index' , 'index')->name('showSetting');
        Route::post('update' , 'update')->name('updateSetting');
    });
});