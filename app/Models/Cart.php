<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /** @use HasFactory<\Database\Factories\CartFactory> */
    use HasFactory;
    // cart zavisi od user-a i od proizvoda
    public function user()
    {
        // 1 cart moze da pripada samo jednom useru
        return $this->belongsTo(User::class);
        // sta da jedan user moze da ima vise cart-ova i da 1 cart moze da pripada vise user-a?
        // Onda bih ovde koristili belongsToMany 
        // Kako ce laravel zakljuciti ime pivot tabele?
        // - Pa kontam da ce videti da se ovva tabela zove cart a druga user i onda ce ih spojiti po alfabetskom rasporedu i razdvojiti sa _
        // - cart_user bi bio neki naziv za pivot tabelu
    }

    // 1 cart moze da sadrzi samo 1 proizvo, a 1 proizvod moze da pripada vise cart-ova
}
