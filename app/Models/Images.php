<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    /** @use HasFactory<\Database\Factories\ImagesFactory> */
    use HasFactory;

    protected $fillable = [
        'path',
        'is_main_image',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
