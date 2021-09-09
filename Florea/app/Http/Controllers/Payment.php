<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;

class Payment extends Controller
{
    public function add_card()
    {
        return view('pages.payment.add');
    }

    public function store_card(Request $request)
    {
        $cart = session()->get('cart');
        $price = 0;
        foreach($cart['items'] as $key => $product){
            $price = $product->price * $product->quantity;
        }
        try{
            $stripeCharge = $request->user()->charge(
                ($price * 100), $request->all()['paymentMethod']['id']
            );
            session()->forget('cart');
        }catch(IncompletePayment $e){
            return $e;
        }
        

        return true;
    }

    public function success()
    {
        return view('pages.payment.success');
    }

    public function error()
    {
        return view('pages.payment.error');
    }
}
