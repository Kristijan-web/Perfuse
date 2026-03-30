<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\clear;


Route::get("/", [PageController::class, 'home'])->name('homePage');
Route::get("/shop", [PageController::class, 'shop'])->name("shopPage");

// kako da