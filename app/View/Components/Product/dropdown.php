<?php

namespace App\View\Components\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;

class dropdown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Product $product, public Bool $banned)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.dropdown');
    }
}
