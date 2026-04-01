<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;



// Route::get("/", [PageController::class, 'home'])->name('homePage');
// Route::get("/shop", [PageController::class, 'shop'])->name("shopPage");


Route::controller(PageController::class)->group(function () {

    Route::get('/', 'home')->name('homePage');
    Route::get('/shop', 'shop')->name('shopPage');
    Route::get('/register', 'register')->name('registerPage');
    Route::get('/login', 'login')->name('loginPage');

});

Route::controller(AuthController::class)->group(function () {

    Route::post('/login', 'login')->name("loginAPI");
    Route::post('/register', 'register')->name("registerAPI");

});

