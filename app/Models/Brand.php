<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    /** @use HasFactory<\Database\Factories\BrandFactory> */
    use HasFactory;

    use SoftDeletes;


    // proizvod moze da pripada jednom brandu, jedan brand moze da ima vise proizovd
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

