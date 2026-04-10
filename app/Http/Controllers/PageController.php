<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\APIFeatures;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Contact;
use App\Models\Ml;
use App\Models\Product;
use App\Models\User;
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
        $products = (new APIFeatures($queryString, Product::query()))->filter()->sort()->getQuery()->paginate(12); /// ovaj query treba da se trigerje
        // $products = $productsQuery->get();
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

    public function order(Request $request)
    {


        // $products = CartItem::where('user_id', $request->user()->id);
        $userCartId = $request->user()->cart->id;
        $products = CartItem::with('product')->where('cart_id', $userCartId)->get();

        // Ovo iznad ali prakticnije napisano
        // $products = $request->user()
        // ?->cart
        // ?->items()
        // ->with('product')
        // ->get()

        return view('pages.user.order', ['products' => $products]);
    }

    public function orderSuccess()
    {
        return view('pages.user.orderSuccess');
    }

    public function author()
    {
        return view('pages.user.author');
    }

    // Ispod su stranice za admina

    public function adminProduct()
    {

        $products = Product::with(['brand', 'waterType', 'discount', 'images', 'mls'])->get();

        return view('pages.admin.product', ['products' => $products]);

    }

    public function adminCreateProduct()
    {
        // mora da prosledim opcije za dropdown
        $brands = Brand::all();
        $waterTypes = WaterType::all();
        $mls = Ml::all();

        return view('pages.admin.product-create', ['brands' => $brands, 'waterTypes' => $waterTypes, 'mls' => $mls]);

    }
    public function adminEditProduct(Product $product)
    {
        // imam 1 proizvod, posto ga imam u memoriji mogu zvati load
        $productData = $product->load(['brand', 'waterType', 'discount', 'images', 'mls']);

        return view('pages.admin.product-edit', ['productData' => $productData]);
    }
    public function adminUser()
    {
        // dohvati sve podakte o userima koji postoje u aplikaciji

        $users = User::with('role');

        return view('pages.admin.user', ['users' => $users]);
    }

    public function adminCreateUser()
    {

        return view('pages.admin.user-create');
    }

    public function adminEditUser(User $user)
    {

        return view('pages.admin.user-edit', ['user' => $user]);


    }

    public function adminContactSubmission()
    {
        // mora da izvadim sve submisione
        // mora da ispisem contact i usera koji ga je napravio 
        $contacts = Contact::with('user')->get();

        return view('pages.admin.contact', ['contacts' => $contacts]);


    }

    public function adminContactSubmissionRespond(Contact $contact)
    {

        return view('pages.admin.contact-respond', ['contact' => $contact]);
    }
    public function adminOrder()
    {

        $orders = User::with('orders')->get();

        return view('pages.admin.order', ['orders' => $orders]);


    }


}




