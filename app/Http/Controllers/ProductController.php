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
        // - Kako cu uopste znati da li je poslata jedna slika ili vise slika
        // - Sta ako je poslato vise slika, kako cu znati koja je main slika?

        // Kako ide sintaksa za prihvatanje slike?
        // $request->file('image');


        // U kom data type stize slika?
        // - Posto je na frontu stavljeno name='images[]' onda stize kao obican niz

        $image = $request->file('images')[0];
        // image name ide u bazu
        // Gde uploadujem sliku
        // Na serveru
        // - Gde na serveru?
        // - Pa da bi je browser video mora da bude u public folderu
        // Kako to izvesti?
        // - Pa verovatno ima neka sintaksa gde navodim file objekat i path gde se uploaduje

        // $file = $request->file('image');

        $name = time() . '_' . $image->getClientOriginalName();

        // $path = $image->storeAs('images', $name, 'public');

        $image->move(public_path('images/ShopPage/Products'), $name);


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
