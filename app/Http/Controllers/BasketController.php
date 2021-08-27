<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket as RequestsBasket;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function add_product(int $id, int $quantity = 1)
    {

        $cart = session()->get('cart');
        
        $product = Product::find($id)->get();
        $cart[] = $product;

        session()->put($cart);
        return back()->with('success', "L'article a bien été ajouté");
    }

    public function update_product(int $id, int $quantity = 1)
    {
        $cart = session()->get('cart');
        $cart[$id]->quantity = $quantity;
        session()->put('cart', $cart);
    }

    public function remove_product(int $id)
    {
        $cart = session()->get('cart');
        $cart[$id] = NULL;
        session()->put('cart', $cart);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsBasket $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function edit(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Basket $basket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Basket  $basket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Basket $basket)
    {
        //
    }
}
