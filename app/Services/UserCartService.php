<?php

namespace App\Services;

use App\Helpers\SessionHelper;
use App\Models\Backend\Product\Product;
use App\Models\Cart;
use App\Models\Cart\CartItem;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserCartService
{
    public function addToCart(array $data): void
    {
        $userId = Auth::id();
        $sessionId = SessionHelper::getSessionId();

        $cart = $this->getOrCreateCart($userId, $sessionId);

        $productId = $data['product_id'];
        $variationId = $data['product_variation_id'] ?? null;
        $quantity = $data['quantity'] ?? 1;
        $isBuyNow = (bool) ($data['is_buy_now'] ?? false);
        $isTotaItemQty = (bool) ($data['is_total_item_qty'] ?? false);
        $product = Product::findOrFail($productId);

        $existingItem = $this->getCartItem($cart->id, $productId, $variationId, $userId, $sessionId);
        $existingQty = $existingItem?->quantity ?? 0;

        if ($isTotaItemQty) {
            $existingQty = 0;
        }

        $this->validateMaxOrderQty($product, $quantity, $existingQty, $isTotaItemQty);

        if ($isBuyNow) {
            $this->handleBuyNow($cart, $existingItem, $productId, $variationId, $quantity, $userId, $sessionId);
        } else {
            $this->handleAddToCart($cart, $existingItem, $productId, $variationId, $quantity, $userId, $sessionId, $isTotaItemQty);
        }
    }

    protected function getOrCreateCart($userId, $sessionId): Cart
    {
        return Cart::firstOrCreate(
            [
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'is_active' => true,
            ],
            ['subtotal' => 0, 'total' => 0]
        );
    }

    protected function getCartItem($cartId, $productId, $variationId = null, $userId = null, $sessionId = null): ?CartItem
    {
        return CartItem::where('cart_id', $cartId)
            ->where(function ($q) use ($userId, $sessionId) {
                if ($userId) {
                    $q->where('user_id', $userId);
                } else {
                    $q->where('session_id', $sessionId);
                }
            })
            ->where('product_id', $productId)
            ->when($variationId, fn($q) => $q->where('product_variation_id', $variationId))
            ->first();
    }

    protected function handleAddToCart(Cart $cart, ?CartItem $existingItem, $productId, $variationId, $quantity, $userId, $sessionId, $isTotaItemQty = false): void
    {
        if ($existingItem) {
            if ($isTotaItemQty) {
                $existingItem->quantity = $quantity;
                $existingItem->save();
            } else {
                $existingItem->increment('quantity', $quantity);
            }
        } else {
            $this->createCartItem($cart->id, $userId, $sessionId, $productId, $variationId, $quantity, false);
        }
    }

    protected function handleBuyNow(Cart $cart, ?CartItem $existingItem, $productId, $variationId, $quantity, $userId, $sessionId): void
    {
        if ($existingItem) {
            $existingItem->update(['is_active' => true]);
        } else {
            $this->createCartItem($cart->id, $userId, $sessionId, $productId, $variationId, $quantity, true);
        }
    }

    protected function createCartItem($cartId, $userId, $sessionId, $productId, $variationId, $quantity, bool $isActive): void
    {
        CartItem::create([
            'cart_id' => $cartId,
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'product_id' => $productId,
            'product_variation_id' => $variationId,
            'quantity' => $quantity,
            'is_active' => $isActive,
        ]);
    }

    public function updateQuantity(CartItem $cartItem, int $quantity): void
    {
        $cartItem->update(['quantity' => $quantity]);
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

    public function validateMaxOrderQty(Product $product, int $newQty, int $existingQty = 0, $isTotaItemQty = false): void
    {
        $totalQty = $existingQty + $newQty;

        if ($product->max_order_qty && $totalQty > $product->max_order_qty) {
            throw new Exception("Max order quantity: {$product->max_order_qty}");
        }
    }
}
