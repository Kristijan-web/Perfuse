<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;

    protected $fillable = ['quantity', 'user_id'];

    // cart zavisi od user-a i od proizvoda
    public function user()
    {
        // 1 cart moze da pripada samo jednom useru, jedan user moze da ima samo jedan
        return $this->belongsTo(User::class);

    }

    // 1 cart moze da sadrzi samo 1 proizvo, a 1 proizvod moze da pripada vise cart-ova
    public function products() // ovo rresava cart_items
    {
        return $this->belongsToMany(Product::class, 'cart_items');
    }






}


