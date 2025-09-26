<?php

namespace App\Http\Controllers\API\Panel\User\Cart;

use App\Helpers\Message;
use App\Helpers\SessionHelper;
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
        $userId = Auth::id();
        $sessionId = SessionHelper::getSessionId();

        $cartItemsQuery = CartItem::with('product', 'product.Brand')
            ->where(function ($q) use ($userId, $sessionId) {
                $q->where('session_id', $sessionId);

                if ($userId) {
                    $q->orWhere('user_id', $userId);
                }
            });

        $cart = CartItem::getAllLists($cartItemsQuery, $request->all(), CartDrawerCartResource::class);

        return Message::success(null, $cart);
    }

    public function count()
    {
        $userId = Auth::id();
        $sessionId = SessionHelper::getSessionId();

        $totalQty = CartItem::where(function ($q) use ($userId, $sessionId) {
            $q->where('session_id', $sessionId);

            if ($userId) {
                $q->orWhere('user_id', $userId);
            }
        })->sum('quantity');

        return Message::success(null, ['totalQty' => $totalQty]);
    }
}
