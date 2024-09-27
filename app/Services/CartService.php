<?php

namespace App\Services;

use App\Models\Cart\CartItem;
use App\Models\User;

class CartService
{
    public function byNowWithQuantity($user_id, $productId, $quantity)
    {
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->is_active = 1;
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'user_id' => $user_id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'is_active' => 1,
            ]);
            $cartItem->save();
        }

        return $cartItem;
    }

    public function addToCartWithQuantity($user_id, $productId, $quantity, $productVariationId = null)
    {
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->product_variation_id = $productVariationId;
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'user_id' => $user_id,
                'product_id' => $productId,
                'product_variation_id' => $productVariationId,
                'quantity' => $quantity,
            ]);
            $cartItem->save();
        }

        return $cartItem;
    }

    public function addToCart($user_id, $productId, $quantity)
    {
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'user_id' => $user_id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            $cartItem->save();
        }

        return $cartItem;
    }

    public function getCart(User $user)
    {
        return $user->cartItems;
    }

    public function updateCartItem(User $user, $id, $quantity)
    {
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return $cartItem;
    }

    public function removeCartItem(User $user, $id)
    {
        $cartItem = CartItem::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }
    }
}
