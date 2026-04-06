<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    /** @use HasFactory<\Database\Factories\OrderLineFactory> */
    use HasFactory;

    // 1 stavka pripada jednom order-u

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // orderline zavisi od user-a i product-a

    // 1 stavka racuna pripada jednom useru
    // 1 user moze imati vise stavki racuna
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // 1 stavka moze da pripada jednom proizvodu
    // 1 proizvod moze da bude u vise stavki
    public function product()
    {
        return $this->belongsTo(Product::class);
    }



}
