<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $products = Product::where('one', 1)->where('visible', '!=', 0)->take(3)->get();
        return view('components.slider', ['products' => $products]);
    }
}
