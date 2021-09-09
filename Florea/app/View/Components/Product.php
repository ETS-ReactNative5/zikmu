<?php

namespace App\View\Components;

use App\Models\Product as ModelsProduct;
use Illuminate\View\Component;

class Product extends Component
{

    public $product;
    public $quantity;
    public $cart;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ModelsProduct $product, ?int $quantity = null)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->cart = session()->get('cart');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product', ['product' => $this->product, 'quantity' => $this->quantity, 'cart' => $this->cart]);
    }
}
