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

    public function brands()
    {

        return $this->belongsTo(Brand::class); // jedan proizvod pripada jednom brand-u
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_items');
    }

    // 1 proizvod moze imati 1 watyer_type
    // 1 water type moze da pripada vise proizvoda
    public function waterTypes()
    {
        return $this->belongsTo(WaterType::class);
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
        return $this->belongsToMany(Ml::class);
    }

}
