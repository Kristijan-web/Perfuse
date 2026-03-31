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
}
