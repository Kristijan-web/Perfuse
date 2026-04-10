<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Images;
use App\Models\MlProduct;
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
    public function store(ProductRequest $request)
    {

        // Note za mene
        // Ja uopste ne bih znao kako da napravim ovu logiku da ne znam kakva mi je struktura baze i kakve su veze u njoj
        $validated = $request->validated();

        $images = $validated['images'];
        $mls = $validated['mls'];



        // mora da se proveri da li je poslat discount ako jeste pravi se novi record u discont tabeli i dodeljuje proizovdu
        // Kako cu znati da li je discount prosledjen?
        // Sta uopste discount tabela ocekuje?

        $discountId = null;

        if ($validated['discount']) {
            // pravi novi discount record
            $discountId = Discount::create(['discount' => $validated['discount'], 'start_date' => $validated['start_date'], 'end_date' => $validated['end_date']])->id;

        }

        // - discount (u procentima)
        // - start_date
        // - end_date


        $productId = Product::create([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'gender' => $validated['gender'],
            'brand_id' => $validated['brand_id'],
            'water_type_id' => $validated['water_type_id'],
            'discount_id' => $discountId
        ])->id;

        // sad za svaku sliku napraviti record u images tabeli


        foreach ($images as $key => $image) {
            // sta ocekuje image model od podataka?
            // - path
            // is_main_image (bool)
            // product_id

            $name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/ShopPage/Products'), $name);

            $imagePath = "images/ShopPage/Products/$name";
            $is_main_image = $key == 0;

            // samo na prvu slike mainImage

            Images::create(['path' => $imagePath, 'is_main_image' => $is_main_image, 'product_id' => $productId]);
        }

        // FAli logika za mls jer ako prosledi 150 mora odem u mlP tabelu i tu da upisem ml_id i product_id
        foreach ($mls as $mlId) {
            // Sta od podataka ocekuje $mls?
            // - ml_id
            // - product_id

            MlProduct::create(['ml_id' => $mlId, 'product_id' => $productId]);
        }

        return redirect()->route('adminProductsPage');



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
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'gender' => ['required', 'string', 'in:muski,zenski'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'water_type_id' => ['required', 'integer', 'exists:water_types,id'],
            'discount' => ['nullable', 'integer'],
            'start_date' => ['nullable'],
            'end_date' => ['nullable'],
            'mls' => ['required'],
            'images' => ['nullable'],
            'main_image_id' => ['nullable', 'integer'],
        ]);

        $discountId = $product->discount_id;
        $hasDiscount = $request->boolean('has_discount') && !empty($validated['discount']);

        if ($hasDiscount) {
            if ($product->discount) {
                $product->discount->update([
                    'discount' => $validated['discount'],
                    'start_date' => $validated['start_date'] ?? null,
                    'end_date' => $validated['end_date'] ?? null,
                ]);
            } else {
                $discountId = Discount::create([
                    'discount' => $validated['discount'],
                    'start_date' => $validated['start_date'] ?? null,
                    'end_date' => $validated['end_date'] ?? null,
                ])->id;
            }
        } elseif ($product->discount) {
            $product->discount->delete();
            $discountId = null;
        }

        $product->update([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'gender' => $validated['gender'],
            'brand_id' => $validated['brand_id'],
            'water_type_id' => $validated['water_type_id'],
            'discount_id' => $discountId,
        ]);

        $product->mls()->sync($validated['mls']);

        $mainImageId = $validated['main_image_id'] ?? null;

        if ($mainImageId && $product->images()->where('id', $mainImageId)->exists()) {
            $product->images()->update(['is_main_image' => false]);
            $product->images()->where('id', $mainImageId)->update(['is_main_image' => true]);
        }

        if ($request->hasFile('images')) {
            $uploadedImages = $request->file('images');
            $shouldSetFirstUploadedAsMain = !$mainImageId && !$product->images()->where('is_main_image', true)->exists();

            foreach ($uploadedImages as $key => $image) {
                $name = time() . '_' . $key . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/ShopPage/Products'), $name);

                Images::create([
                    'path' => "images/ShopPage/Products/$name",
                    'is_main_image' => $shouldSetFirstUploadedAsMain && $key === 0,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {

        // Posto radim soft delete za proizvod kontam da nema potrebe da brisem i slike koje pripadaju proizvodu

        $product->delete();


        return redirect()->back();

    }
}
