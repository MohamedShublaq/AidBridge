<?php

use App\Http\Controllers\Ngo\DonorController;
use App\Http\Controllers\Ngo\AidController;
use App\Http\Controllers\Ngo\AidDistributionController;
use App\Http\Controllers\Ngo\CivilianController;
use App\Http\Controllers\Ngo\HomeController;
use App\Http\Controllers\Ngo\LocationController;
use App\Http\Controllers\Ngo\ProfileController;
use App\Http\Controllers\Ngo\ProviderController;
use App\Http\Controllers\Ngo\RequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Ngo Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware'=>'auth:ngo', 'prefix'=>'ngo', 'as'=>'ngo.'] , function(){

    //*********************// Home Controller //*********************//
    Route::get('/home' , [HomeController::class,'index'])->name('home');

    //*********************// Profile Controller //*********************//
    Route::controller(ProfileController::class)->group(function(){
        Route::get('/profile' , 'showProfile')->name('showProfile');
        Route::post('/profile' , 'updateProfile')->name('updateProfile');
        Route::get('/change/password' , 'showChangePassword')->name('showChangePassword');
        Route::post('/change/password' , 'changePassword')->name('changePassword');
    });

    //*********************// Civilian Controller //*********************//
    Route::controller(CivilianController::class)->prefix('civilians')->as('civilians.')->group(function(){
        Route::get('/status/{status}' , 'index')->name('index');
        Route::get('/import/file' , 'showImportFile')->name('showImportFile');
        Route::post('/import/file' , 'importFile')->name('importFile');
        Route::post('/export/file/{status}' , 'exportFile')->name('exportFile');
        Route::post('/approve' , 'approve')->name('approve');
        Route::post('/reject' , 'reject')->name('reject');
        Route::get('/{id}/show' , 'show')->name('show');
        Route::post('/delete' , 'delete')->name('delete');
        Route::get('/show/trashed' , 'showTrashed')->name('showTrashed');
        Route::post('/restore' , 'restore')->name('restore');
        Route::get('/download/template' , 'downloadTemplate')->name('downloadTemplate');
    });

    //*********************// Donor Controller //*********************//
    Route::resource('donors' , DonorController::class)->except(['index','edit','update']);
    Route::controller(DonorController::class)->prefix('donors')->as('donors.')->group(function(){
        Route::get('/status/{status}' , 'index')->name('index');
        Route::post('/approve' , 'approve')->name('approve');
        Route::post('/reject' , 'reject')->name('reject');
        Route::get('/show/trashed' , 'showTrashed')->name('showTrashed');
        Route::post('/restore' , 'restore')->name('restore');
    });

    //*********************// Location Controller //*********************//
    Route::resource('locations' , LocationController::class)->except(['create','edit','show']);

    //*********************// Aid Controller //*********************//
    Route::resource('aids' , AidController::class)->except('show');

    //*********************// Provider Controller //*********************//
    Route::resource('providers' , ProviderController::class)->except(['create','edit','show']);

    //*********************// Request Controller //*********************//
    Route::controller(RequestController::class)->as('requests.')->group(function(){
        Route::get('/requests/{aid_id}/status/{status}' , 'show')->name('show');
        Route::post('/request/aid/approve' , 'approve')->name('approve');
        Route::post('/requests/aid/multiApprove' , 'multiApprove')->name('multiApprove');
        Route::post('/request/aid/reject' , 'reject')->name('reject');
        Route::post('/requests/{aid_id}/export/file/{status}' , 'exportFile')->name('exportFile');
        Route::get('/download/template' , 'downloadTemplate')->name('downloadTemplate');
        Route::post('/import/file' , 'importFile')->name('importFile');
    });

    //*********************// AidDistribution Controller //*********************//
    Route::controller(AidDistributionController::class)->prefix('aid/distribution')->as('aidDistrbutions.')->group(function(){
        Route::post('/change/status' , 'changeStatus')->name('changeStatus');
    });
});