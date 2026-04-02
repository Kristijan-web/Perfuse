<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\APIFeatures;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home()
    {
        return view('pages.user.home');
    }

    public function shop(Request $request)
    {
        // mora da prosledim proizvode, mora da uzmem njihove brandove, water-type-ove, image-e, discount-ove i koju militrazu imaju

        // korisnik moze da prosledi /products?minPrice=10&maxPrice=20
        // - Ja samo treba da pozovem APIFeatures i da mu prosledim query builder za model i queryString
        // Kako ide sintaksa da pristupim query string-u
        $queryString = $request->query(); // vraca asocijativni array sa vrednostima 
        $productsQuery = (new APIFeatures($queryString, Product::query()))->filter()->getQuery(); /// ovaj query treba da se trigerje
        $products = $productsQuery->get();
        // $products = Product::with(['brand', 'waterType', 'images', 'discount', 'mls'])->get();
        // ovo vraca sve recorde a meni trebaju samo title-ovi
        $brands = Brand::all();
        return view('pages.user.shop', ['products' => $products, 'brands' => $brands, 'request' => $request]);
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




