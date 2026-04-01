<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;




Route::controller(PageController::class)->group(function () {

    Route::get('/', 'home')->name('homePage');
    Route::get('/shop', 'shop')->name('shopPage');

    // ako je korisnik ulogovan on ne bi trebao da moze da pristupa login i register stranicama

    Route::middleware('guest')->group(function () {
        Route::get('/register', 'register')->name('registerPage');
        Route::get('/login', 'login')->name('loginPage');

    });

});

Route::controller(AuthController::class)->group(function () {

    Route::post('/login', 'login')->name("loginAPI");
    Route::post('/register', 'register')->name("registerAPI");

});

