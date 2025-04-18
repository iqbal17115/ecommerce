<?php

namespace App\Http\Controllers\API\Panel\User\Cart;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\CartDrawer\CartDrawerCartResource;
use App\Models\Cart\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartDrawerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = CartItem::getAllLists(CartItem::with('product')->where("user_id", Auth::user()->id), $request->all(), CartDrawerCartResource::class);

        return Message::success(null, $cart);
    }

    public function count()
    {
        $totalQty = CartItem::where('user_id', Auth::id())->sum('quantity');

        return Message::success(null, ['totalQty' => $totalQty]);
    }
}
