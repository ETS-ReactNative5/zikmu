<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket as RequestsBasket;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    public function add_product(Request $request)
    {
        $product = Product::find($request->all()['product']);
        $quantity = $request->all()['quantity'];

        $cart = session()->get('cart');

        if(isset($cart['items'][$product['id']]) && !empty($cart['items'][$product['id']])){
            $cart['items'][$product['id']]->quantity = $quantity;
        }else{
            $cart['items'][$product['id']] = $product;
            $cart['items'][$product['id']]->quantity = $quantity ?? 1;
        }
        
        session()->put('cart', $cart);
        return back()->with('success', "L'article a bien été ajouté");
    }

    public function update_product(Request $request)
    {
        $product = Product::find($request->all()['product']);
        $quantity = $request->all()['quantity'];

        $cart = session()->get('cart');
        $cart['items'][$product['id']]->quantity = $quantity;
        $message = 'Quantité modifiée';
        if($cart['items'][$product['id']]['quantity'] == 0){
            unset($cart['items'][$product['id']]);
            $message = "Article bien supprimé";
        }
        session()->put('cart', $cart);

        return back()->with('success', $message);
    }

    public function remove_product(Request $request)
    {

        $product = Product::find($request->all()['product']);
        $quantity = $request->all()['quantity'];

        $cart = session()->get('cart');
        $cart['items'][$product['id']]->quantity -= $quantity;
        if($cart['items'][$product['id']]['quantity'] == 0){
            unset($cart['items'][$product['id']]);
        }
        session()->put('cart', $cart);

        return back()->with('success', 'Article bien supprimé');
    }

    public function total_price()
    {
        $cart = session()->get('cart');
        $price = 0;
        if(!empty($cart)){
            if($cart['items']){
                foreach($cart['items'] as $key => $product){
                    $price += $product->price * $product->quantity;
                }
            }
        }
        return $price;
    }

    public function empty_cart()
    {
        session()->forget('cart');
        return back()->with('success', 'Votre panier est vidé');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = session()->get('cart');
        $totalProducts = 0;
        if($products){
            foreach($products['items'] as $key => $item){
                if($item->quantity){
                    $totalProducts = $item->quantity ?? 1;
                }else{
                    $totalProducts++;
                }
            }
        }
        return view('pages.basket.index', ['products' => $products, 'totalPrice' => $this->total_price(), 'totalProducts' => $totalProducts]);
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
    public function store()
    {
        $cart = session()->get('cart');
        if(!empty($cart)){
            $basket = new Basket();
            $basket->products = json_encode($cart['items']);
            $basket->user_id = Auth::user()['id'];
            $basket->save();
            return redirect(route('payment.add_card'));
        }
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
