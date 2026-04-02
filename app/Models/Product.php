<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    use SoftDeletes;

    public function brand()
    {

        return $this->belongsTo(Brand::class); // jedan proizvod pripada jednom brand-u
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items');
    }

    // 1 proizvod moze imati 1 watyer_type
    // 1 water type moze da pripada vise proizvoda
    public function waterType()
    {
        return $this->belongsTo(WaterType::class);
    }

    // 1 PROIZVOD moze da ima 1 discount 
    // 1 discount moze da pripada 1 proizvodu
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function discountHistories()
    {
        return $this->hasMany(DiscountHistory::class);
    }


    // 1 proizvod moze da sadrzi vise slika
    // 1 slika moze da pripada jednom proizvodu
    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function mls()
    {
        return $this->belongsToMany(Ml::class, 'ml_products'); // mora ml_products jer eloquent ocekuje da se pivot tabela zove ml_product a ne ml_products i raspored dal ce products_ml ili ml_products zavisi od prvog slova nezavisnih tabela i onda ih sortira po prvom slovu i doda _
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

}
