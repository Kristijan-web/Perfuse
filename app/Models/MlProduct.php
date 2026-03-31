<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MlProduct extends Model
{
    /** @use HasFactory<\Database\Factories\MlProductFactory> */

    use HasFactory;

    // 1 ml_product moze da pripada jednom proizvodu
    // 1 ml_product moze da pripada jednom ml

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function ml()
    {
        return $this->belongsTo(Ml::class);
    }


}
