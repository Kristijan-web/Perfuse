<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        return view('pages.user.home');
    }

    public function shop()
    {
        // mora da prosledim proizvode, mora da uzmem njihove brandove, water-type-ove, image-e, discount-ove i koju militrazu imaju
        $products = Product::with(['brand', 'waterType', 'images', 'discount', 'mls'])->get();
        dd($products[0]->brand->title);
        return view('pages.user.shop');
    }

    public function login()
    {
        return view('pages.user.login');
    }

    public function register()
    {
        return view("pages.user.register");
    }

    public function cart()
    {
        return view('pages.user.cart');
    }

}


