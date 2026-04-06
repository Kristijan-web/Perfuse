<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\APIFeatures;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\WaterType;
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
        $productsQuery = (new APIFeatures($queryString, Product::query()))->filter()->sort()->getQuery(); /// ovaj query treba da se trigerje
        $products = $productsQuery->get();
        // $products = Product::with(['brand', 'waterType', 'images', 'discount', 'mls'])->get();
        // ovo vraca sve recorde a meni trebaju samo title-ovi
        $brands = Brand::all();
        $waterTypes = WaterType::all();
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('pages.user.shop', ['products' => $products, 'brands' => $brands, 'request' => $request, 'waterTypes' => $waterTypes, 'minPrice' => $minPrice, 'maxPrice' => $maxPrice]);
    }

    public function productDetails(Product $product, Request $request)
    {

        $product = $product->load(['brand', 'waterType', 'discount', 'images', 'mls']);

        return view('pages.user.productDetails', ['product' => $product]);
    }

    public function login()
    {
        return view('pages.user.login');
    }

    public function register()
    {
        return view("pages.user.register");
    }

    public function cart(Request $request)
    {

        $userCart = Cart::where('user_id', $request->user()->id)?->first();

        $userProducts = CartItem::with('product')->where('cart_id', $userCart?->id)->get();




        return view('pages.user.cart', ['products' => $userProducts]);
    }

    public function contact()
    {
        return view('pages.user.contact');
    }


}




