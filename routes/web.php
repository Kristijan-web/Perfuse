<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


// Sav view je u PageController-u

// Svi ostali kontroleri su "API" kontroleri

Route::controller(PageController::class)->group(function () {

    // bez obzira na role
    Route::get('/', 'home')->name('homePage');
    Route::get('/shop', 'shop')->name('shopPage');
    Route::get('/shop/product/{product}', 'productDetails')->name("productDetails");
    Route::get('/author', 'author')->name('authorPage');


    Route::middleware('guest')->group(function () {
        Route::get('/register', 'register')->name('registerPage');
        Route::get('/login', 'login')->name('login');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/contact', 'contact')->name('contactpage');
        Route::get('/cart', 'cart')->name('cartPage');
        Route::get('/order', 'order')->name('orderPage');
        Route::get('/order/success', 'orderSuccess')->name('orderSuccessPage');
    });

    Route::middleware('isAdmin')->group(function () {
        Route::get("/admin", 'adminProduct')->name('adminProductsPage');
        Route::get('/admin/users', 'adminUser')->name('adminUsersPage');
        Route::get('/admin/contacts', 'adminContactSubmission')->name('adminSubmissionsPage');
    });



});

Route::controller(AuthController::class)->group(function () {

    Route::middleware('guest')->group(function () {
        Route::post('/login', 'login')->name("loginAPI");
        Route::post('/register', 'register')->name("registerAPI");
    });

    Route::get('/logout', 'logout')->name("logoutAPI"); // iso bih sa POST umeto GET jer ipak saljemo neke podatke a to je sesija korisnika kroz header, mada obicno po REST konvecniji je namena post-a da kreira nesto u bazi, a sa logout ne pravimo nista u bazi

});

Route::controller(ContactController::class)->middleware('auth')->group(function () {

    Route::post('/api/contacts', 'store')->name('createContactAPI');

});

Route::controller(CartController::class)->middleware('auth')->group(function () {

    Route::post('/api/carts/{product}', 'store')->name('createCartAPI');
    Route::delete('/api/carts/{cart}', 'destroy')->name('deleteCartItemAPI');
});

Route::controller(OrderController::class)->middleware('auth')->group(function () {

    Route::post('/api/orders', 'store')->name('createOrderAPI');

});

Route::controller(ProductController::class)->middleware('isAdmin')->group(function () {
    Route::delete('/api/products/{product}', 'destroy')->name('deleteProductAPI');
});
