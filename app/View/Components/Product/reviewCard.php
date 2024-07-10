<?php

namespace App\View\Components\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Review;

class reviewCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Review $review)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product.review-card');
    }
}
