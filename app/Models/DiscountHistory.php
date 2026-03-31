<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountHistory extends Model
{
    /** @use HasFactory<\Database\Factories\DiscountHistoryFactory> */
    use HasFactory;

    // 1 discount_history moze da pripada samo 1 proizvod
    // 1 proizvod moze da se ponavlja vise puta u 1. discount_history-u
    // ovoj je hasMany unutar product-a
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
