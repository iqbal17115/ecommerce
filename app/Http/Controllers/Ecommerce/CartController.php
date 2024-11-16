<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function updateProductStatus(Request $request)
    {
        $product_id = $request->input('product_id');
        $status = $request->input('status');

        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])) {
            $cart[$product_id]['status'] = $status;
        }
        session()->put('cart', $cart);

        return response()->json(['message' => 'Product status updated successfully!']);
    }

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
                "image" => $request->image,
                "status" => 0
            ];
            $new_product = array(
                "id" => $request->id,
                "name" => $request->name,
                "quantity" => 1,
                "your_price" => $request->your_price,
                "sale_price" => $request->sale_price,
                "image" => $request->image,
                "status" => 0,
            );
        }

        session()->put('cart', $cart);
        return response()->json(['cart' => $cart, 'new_product'=>$new_product]);
    }


    public function index()
    {
        $user_id = auth()?->user()->id ?? null;
        $cart_products = session('cart');
        $estimatedDeliveryDate = Carbon::today()->addDay()->format('d F');
        return view('ecommerce.cart', compact('cart_products', 'estimatedDeliveryDate', 'user_id'));
    }
}
