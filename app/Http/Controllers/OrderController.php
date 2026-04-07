<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;

class OrderController extends Controller
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
    public function store(CreateOrderRequest $request)
    {
        //
        // logika za pravljenje novog order-a i order_line-a
        // Sta mi sve treba od podataka da bih napravio order?
        // Kada je order uspesan TREBA OCISTITI CART
        // $table->string('name');
        // $table->string('lastname');
        // $table->string('email');
        // $table->string('phone_number');
        // $table->string('adress');
        // $table->string('city');
        // $table->string('postal_code');
        // $table->text('note')->nullable();
        // $table->integer("total_price");
        // $table->integer("total_quantity");
        // $table->foreignId("user_id")->constrained();

        // treba bi user_id
        $validated = $request->validated();

        $userId = $request->user()->id;
        $products = $request->input('products');
        // kako cu mu znati quantity za proizvod
        // Kako da posaljem back-u proizvod sa njegovim id-em i quantity-em?
        // - Jedino da nekako prosledim asocijativni niz gde je vrednost objekat
        // products ce biti niz id-eva



        $orderId = Order::create([
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'adress' => $validated['adress'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'note' => $validated['note'] ?? null,
            'total_price' => $validated['total_price'],
            'total_quantity' => $validated['total_quantity'],
            'user_id' => $userId,
        ])->id;


        // narudzbina isto treba sadrzati id-eve proizvoda koji ce biti u orderLines
        // imam order_id = $urderId
        // trebaju mi svi proizvodi, to mogu da prosledim u body u kljucu products kao niz

        // za svaki product_id u $products treba napravi novi insert u OrderLines tabeli

        foreach ($products as $product) {
            // $product je $product_id
            // Sta ocekuje tablea order line?
            // - order_id
            // - product_id
            // - quantity
            // dd($product['product_id']);

            $productId = $product['product_id'];
            $productQuantity = $product['product_id'];

            OrderLine::create(['order_id' => $orderId, 'product_id' => $productId, 'quantity' => $productQuantity]);

        }

        // obrisi sve iz carta za ovog usera
        $cart = Cart::where('user_id', $userId)->first();
        $cartId = $cart->id;
        $cart->delete();
        // i mora sve iz cart_items

        CartItem::where('cart_id', $cartId)->delete();


        session()->flash('success', 'Narudzbina uspesno kreirana');

        return redirect()->route('orderSuccessPage');


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
    public function destroy(string $id)
    {
        //
    }
}
