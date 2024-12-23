<?php

use App\Http\Controllers\FrontEnd\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

//*********************// Login Controller //*********************//
Route::controller(HomeController::class)->group(function(){
    Route::get('/' , 'home')->name('showHome');
    Route::post('/contact' , 'contact')->name('contact');
});