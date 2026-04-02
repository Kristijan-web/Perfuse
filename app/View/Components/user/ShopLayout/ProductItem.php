<?php

namespace App\View\Components\user\ShopLayout;

use App\Models\Product;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductItem extends Component
{
    /**
     * Create a new component instance.
     */


    public $product;
    public function __construct($product)
    {
        //
        // ovde definisem propove i njihove tipova podataka

        $this->product = $product;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user.shop-layout.product-item');
    }
}
