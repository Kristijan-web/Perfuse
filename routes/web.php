<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\clear;


// Route::get("/", [PageController::class, 'home'])->name('homePage');
// Route::get("/shop", [PageController::class, 'shop'])->name("shopPage");


Route::controller(PageController::class)->group(function () {

    Route::get('/', 'home')->name('homePage');
    Route::get('/shop', 'shop')->name('shopPage');
    Route::get("/register", 'register')->name('registerPage');

});

// Sta ako zelim da zovem samo metode iz controlera bez da pisem samo controller


// kako da