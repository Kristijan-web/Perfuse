<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;



Route::controller(PageController::class)->group(function () {

    Route::get('/', 'home')->name('homePage');
    Route::get('/shop', 'shop')->name('shopPage');
    Route::get('/cart', 'cart')->name('cartPage');
    Route::get('/contact', 'contact')->name('contactpage');
    Route::get('/shop/product/{product}', 'productDetails')->name("productDetails");

    // Route::middleware(['auth', 'isAdmin'])->group(function () {

    // });

    Route::middleware('guest')->group(function () {
        Route::get('/register', 'register')->name('registerPage');
        Route::get('/login', 'login')->name('loginPage');
    });

});

Route::controller(AuthController::class)->group(function () {

    Route::middleware('guest')->group(function () {
        Route::post('/login', 'login')->name("loginAPI");
        Route::post('/register', 'register')->name("registerAPI");
    });

    Route::post('/logout', 'logout')->name("logoutAPI"); // iso bih sa POST umeto GET jer ipak saljemo neke podatke a to je sesija korisnika kroz header

});
