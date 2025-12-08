<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cart\CartItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function byNowWithQuantity($user_id, $productId, $quantity, $productVariationId = null)
    {
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->product_variation_id = $productVariationId;
            $cartItem->is_active = 1;
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'user_id' => $user_id,
                'product_id' => $productId,
                'product_variation_id' => $productVariationId,
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

    // public function addToCart($user_id, $productId, $quantity)
    // {
    //     $cartItem = CartItem::where('user_id', $user_id)
    //         ->where('product_id', $productId)
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->quantity += $quantity;
    //         $cartItem->save();
    //     } else {
    //         $cartItem = new CartItem([
    //             'user_id' => $user_id,
    //             'product_id' => $productId,
    //             'quantity' => $quantity,
    //         ]);
    //         $cartItem->save();
    //     }

    //     return $cartItem;
    // }

    public function addToCart($userId, $productId, $quantity)
    {
        // Find or create the active cart for the user
        $cart = Cart::firstOrCreate(
            ['user_id' => $userId, 'is_active' => true],
            ['subtotal' => 0, 'total' => 0, 'coupon_discount' => 0]
        );

        // Check if the product already exists in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Update the quantity if the product is already in the cart
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Add a new item to the cart
            $cartItem = new CartItem([
                'cart_id' => $cart->id,
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
            $cartItem->save();
        }

        // Update the cart subtotal
        $this->updateCartTotals($cart);

        return $cartItem;
    }

    /**
     * Update the subtotal and total of the cart.
     *
     * @param Cart $cart
     * @return void
     */
    private function updateCartTotals(Cart $cart)
    {
        $cartItems = CartItem::where('cart_id', $cart->id)->get(); // Get all cart items

        $subtotal = 0;

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product; // Assuming you have a relationship with Product
            $price = $this->getPrice($product); // Get the price based on your method
            $subtotal += $cartItem->quantity * $price; // Add the total for each cart item
        }

        $total = $subtotal - $cart->coupon_discount; // Subtract coupon discount from subtotal

        // Update cart totals
        $cart->update([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    public function getPrice(Product $product)
    {
        $currentDate = now();
        if (
            $product->sale_price &&
            $product->sale_start_date &&
            $product->sale_end_date &&
            $product->sale_start_date <= $currentDate &&
            $product->sale_end_date >= $currentDate
        ) {
            return $product->sale_price;
        }

        return $product->your_price;
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
