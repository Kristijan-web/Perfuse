<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kako uraditi upload slike/slika?
        // - U kom data type-u stize slika?
        // - Kako ide sintaksa za prihvatanje slike? 
        // - Sta ako je poslato vise slika, kako cu znati koja je main slika?

        // U kom data type stize slika?
        // - Pretpostavljam objekat

        // Kako ide sintaksa za prihvatanje slike?
        // 

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->back();

    }
}
