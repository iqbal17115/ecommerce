<?php

namespace App\Helpers;

use App\Enums\OrderStatusEnum;
use App\Models\Cart\CartItem;
use Illuminate\Support\Facades\Auth;

class CartItemHelper
{
    public static function queryCartItemsByUserOrSession(?int $isActive = null)
    {
        $userId = Auth::id();
        $sessionId = SessionHelper::getSessionId();

        return CartItem::when(!is_null($isActive), function ($query) use ($isActive) {
            $query->where('is_active', $isActive);
        })
            ->where(function ($q) use ($userId, $sessionId) {
                $q->where('session_id', $sessionId);

                if ($userId) {
                    $q->orWhere('user_id', $userId);
                }
            });
    }
}
