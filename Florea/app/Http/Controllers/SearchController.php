<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(string $q)
    {
        $final = '';
        foreach(Product::where('title', 'like', "%{$q}%")->where('visible', '!=', 0)->get() as $key => $product){
            $final .= $this->get_product_template($product);
        }
        echo(json_encode($final));
    }

    public function get_product_template($product)
    {
        return view('components/search_product', ['product' => $product]);
    }

    public function get(Request $request)
    {
        $request->validate([
            'q' => 'required',
        ]);
        $search = [];
        $search['categories'] = Category::where('title', 'like', "%{$request['q']}%")->get();
        $search['products'] = Product::where('title', 'like', "%{$request['q']}%")->where('visible', '!=', 0)->get();

        return view('pages.search', ['search' => $search, 'q' => $request['q']]);
    }
}
