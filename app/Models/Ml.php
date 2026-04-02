<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ml extends Model
{
    /** @use HasFactory<\Database\Factories\MlFactory> */
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(MlProduct::class, 'ml_products'); // mora 2. arugment jer ocekuje da se pivot tabela zove ml_product a ne ml_products
    }
}
