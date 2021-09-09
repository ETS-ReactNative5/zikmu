<?php

namespace App\View\Components;

use App\Models\Basket;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Navbar extends Component
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
        // session()->forget('cart');
        $categories = Category::where('belongs_to', NULL)->get();
        foreach($categories as $key => $item){
            $categories[$key]['childrens'] = Category::where('belongs_to', $item->id)->get();
        }
        $cart = session()->get('cart');
        $totalProducts = 0;
        if(!empty($cart)){
            foreach($cart['items'] as $key => $item){
                if($item->quantity){
                    $totalProducts += $item->quantity ?? 1;
                }else{
                    $totalProducts++;
                }
            }
        }
        
        return view('components.navbar', ['categories' => $categories, 'cart' => $cart, 'totalProducts' => $totalProducts, 'user' => $user ?? null]);
    }
}
