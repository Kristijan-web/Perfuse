<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterType extends Model
{
    /** @use HasFactory<\Database\Factories\WaterTypeFactory> */
    use HasFactory;
    // 1 proizvod moze da sadrzi 1 water_type
    // 1 water_type moze da pripada vise proizvoda

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
