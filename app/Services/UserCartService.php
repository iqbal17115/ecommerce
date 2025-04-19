<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Cart\CartItem;
use Illuminate\Support\Facades\Auth;

class UserCartService
{
    public function addToCart(array $data): void
    {
        $userId = Auth::id();
        $cart = $this->getOrCreateCart($userId);

        $productId = $data['product_id'];
        $variationId = $data['product_variation_id'] ?? null;
        $quantity = $data['quantity'] ?? 1;
        $isBuyNow = (bool) ($data['is_buy_now'] ?? false);

        $existingItem = $this->getCartItem($cart->id, $productId, $variationId);

        if ($isBuyNow) {
            $this->handleBuyNow($cart, $existingItem, $productId, $variationId, $quantity, $userId);
        } else {
            $this->handleAddToCart($cart, $existingItem, $productId, $variationId, $quantity, $userId);
        }
    }

    protected function getOrCreateCart($userId): Cart
    {
        return Cart::firstOrCreate(
            ['user_id' => $userId, 'is_active' => true],
            ['subtotal' => 0, 'total' => 0]
        );
    }

    protected function getCartItem($cartId, $productId, $variationId = null): ?CartItem
    {
        return CartItem::where('cart_id', $cartId)
            ->where('user_id', Auth::user()->id)
            ->where('product_id', $productId)
            ->when($variationId, fn($q) => $q->where('product_variation_id', $variationId))
            ->first();
    }

    protected function handleAddToCart(Cart $cart, ?CartItem $existingItem, $productId, $variationId, $quantity, $userId): void
    {
        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
        } else {
            $this->createCartItem($cart->id, $userId, $productId, $variationId, $quantity, false);
        }
    }

    protected function handleBuyNow(Cart $cart, ?CartItem $existingItem, $productId, $variationId, $quantity, $userId): void
    {
        // Deactivate all other cart items
        CartItem::where('cart_id', $cart->id)->update(['is_active' => false]);

        if ($existingItem) {
            // Just mark this as active, don't update quantity
            $existingItem->update(['is_active' => true]);
        } else {
            $this->createCartItem($cart->id, $userId, $productId, $variationId, $quantity, true);
        }
    }

    protected function createCartItem($cartId, $userId, $productId, $variationId, $quantity, bool $isActive): void
    {
        CartItem::create([
            'cart_id' => $cartId,
            'user_id' => $userId,
            'product_id' => $productId,
            'product_variation_id' => $variationId,
            'quantity' => $quantity,
            'is_active' => $isActive,
        ]);
    }

    public function removeItem(CartItem $cartItem): void
    {
        $cartId = $cartItem->cart_id;

        $cartItem->delete();

        $remainingItems = CartItem::where('cart_id', $cartId)->count();

        if ($remainingItems === 0) {
            Cart::where('id', $cartId)->delete();
        }
    }
}
