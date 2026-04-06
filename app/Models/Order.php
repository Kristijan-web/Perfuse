<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    // order i orderline

    // 1 order ima vise stavki(orderline)
    // 1 stavka(orderline) pripada jednom order-u

    public function orders()
    {
        return $this->hasMany(OrderLine::class);
    }

    // 1 order moze da pripada 1 useru
    // 1 user moze da ima vise ordera

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
