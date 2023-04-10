<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function decreaseQty(Request $request) {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id]) && $cart[$request->id]['quantity'] > 1) {
            $cart[$request->id]['quantity']--;
        }
        session()->put('cart', $cart);
        return response()->json(['cart' => $cart]);
    }
    public function increaseQty(Request $request) {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        }
        session()->put('cart', $cart);
        return response()->json(['cart' => $cart]);
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return response()->json(['cart' => $cart]);
    }
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $new_product = [];
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity']++;
        } else {
            $cart[$request->id] = [
                "name" => $request->name,
                "quantity" => 1,
                "your_price" => $request->your_price,
                "sale_price" => $request->sale_price,
                "image" => $request->image
            ];
            $new_product = array(
                "id" => $request->id,
                "name" => $request->name,
                "quantity" => 1,
                "your_price" => $request->your_price,
                "sale_price" => $request->sale_price,
                "image" => $request->image
            );
        }

        session()->put('cart', $cart);
        return response()->json(['cart' => $cart, 'new_product'=>$new_product]);
    }


    public function index()
    {
        return view('ecommerce.cart');
    }
}