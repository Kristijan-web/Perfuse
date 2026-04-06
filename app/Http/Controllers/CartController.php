<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {

        // Treba prvo da se ustanovi da li vec postoji cart za tog usera ili ne
        // Kako ovo uraditi?
        // - Odem u cart tabelu i proverim da li postoji cart za usera
        // Problem je tt
        // korisnik mora biti ulogvan


        $userCart = Cart::where('user_id', $request->user()->id)->first();

        if ($userCart) {
            // logika ako postoji cart
            // - Voditi racuna dali proizvod vec postoji u cart-u ili je ovo prvo pravljenje cart-a
            // - Voditi racuna kada korisnik brise proizvodew iz cart-a, ako nema vise proizvoda u cart_items onda obrisati cart u bazi


            // sad treba proveriti da li proizvod postoji u cart_items

            $productId = $product->id;

            $cartItemProduct = CartItem::where('cart_id', $userCart->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItemProduct) {
                // sta ako proizvod vec postoji u cart_items?
                // - Update-uje se samo quantity

                $cartItemProduct->update(['quantity' => $cartItemProduct->quantity + 1]);
            }

            if (!$cartItemProduct) {
                // sta ako porizvod ne postoji u cart_items?
                // - Pravi se novi record u cart_items

                CartItem::create(['cart_id' => $userCart->id, 'product_id' => $product->id, 'quantity' => 1]);
            }

        }

        if (!$userCart) {
            // logika ako ne postoji cart

            // Sta se radi kada ne postoji cart?
            // - pravi se novi cart record u carts tabeli i cart_orders tabeli


            $cartRecordId = $request->user()->cart()->create([
                'quantity' => 1
            ])->id;


            CartItem::create(['cart_id' => $cartRecordId, 'product_id' => $product->id, 'quantity' => 1]);

        }

        // Kako cu znati da je prozivod uspesno dodat u korpu
        // ovde mogu da upisem u sesiju

        session()->put('success', 'Proizvod uspesno dodat u korpu');
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, CartItem $cartItem)
    {
        $userCart = Cart::where('user_id', $request->user()->id)->first();

        if (!$userCart || $cartItem->cart_id !== $userCart->id) {
            abort(403);
        }

        $cartItem->delete();

        if (!CartItem::where('cart_id', $userCart->id)->exists()) {
            $userCart->delete();
        }

        session()->put('success', 'Proizvod uspesno uklonjen iz korpe');

        return redirect()->route('cartPage');
    }
}
