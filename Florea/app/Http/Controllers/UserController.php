<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $baskets = Basket::where('user_id', Auth::user()['id'])->get();
        foreach($baskets as $key => $basket){
            $basket->products = json_decode($basket['products']);
            foreach($basket->products as $key => $product){
                $product->products[$key] = Product::find($product->id);
            }
        }
        return view('dashboard', ['baskets' => $baskets]);
    }
}
