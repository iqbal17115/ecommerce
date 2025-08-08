<?php

namespace App\Services;

use App\Enums\CouponScopeEnum;
use App\Helpers\CartItemHelper;
use App\Helpers\SessionHelper;
use App\Models\Backend\Product\Product;
use App\Models\Cart;
use App\Models\Cart\CartItem;
use App\Models\CartItemCoupon;
use App\Models\Coupon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplyCouponProductService
{
    public function applyCoupon(array $validatedData)
    {
        DB::beginTransaction();

        try {
            $couponCode = $validatedData['coupon_code'];
            $userId = Auth::id() ?? null;

            $coupon = Coupon::where('code', $couponCode)->first();
            if (!$coupon) {
                throw new \Exception('Coupon not found');
            }

            if (!$coupon->is_active) {
                throw new \Exception('Coupon is not active');
            }

            $now = now();
            if ($now < $coupon->valid_from || $now > $coupon->valid_to) {
                throw new \Exception('Coupon is not valid at this time');
            }

            if ($coupon->max_uses !== null && $coupon->usage_limit_per_user < $coupon->usage_count) {
                throw new \Exception('Coupon has reached the maximum usage limit');
            }

            $sessionId = SessionHelper::getSessionId();
            $cart = Cart::where(function ($q) use ($userId, $sessionId) {
                $q->where('session_id', $sessionId);
                if ($userId) {
                    $q->orWhere('user_id', $userId);
                }
            })->where('is_active', true)->first();

            if (!$cart) {
                throw new \Exception('No active cart found for this user');
            }

            $cartItems = CartItemHelper::queryCartItemsByUserOrSession(1)->get();
            $totalDiscountValue = 0;
            $isApplied = false;

            foreach ($cartItems as $cartItem) {
                if ($this->isProductEligibleForCoupon($coupon, $cartItem)) {
                    $discountValue = $this->calculateDiscount($coupon, $cartItem);

                    CartItemCoupon::create([
                        'coupon_id' => $coupon->id,
                        'cart_item_id' => $cartItem->id,
                        'value' => $discountValue,
                    ]);

                    $totalDiscountValue += $discountValue;
                    $isApplied = true;
                }
            }

            if (!$isApplied) {
                throw new \Exception('Coupon not applicable to any products in your cart');
            }

            if ($cart->coupon_discount > 0) {
                throw new \Exception('Coupon already applied to the cart');
            }

            $coupon->increment('usage_count');
            $this->applyCouponToCart($cart, $coupon, $totalDiscountValue);

            DB::commit();

            return 'Coupon applied successfully';
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex; // important: rethrow
        }
    }


    /**
     * Apply the coupon to the entire cart.
     *
     * @param Cart $cart
     * @param Coupon $coupon
     * @param float $discountValue
     * @return void
     */
    private function applyCouponToCart(Cart $cart, Coupon $coupon, float $discountValue)
    {
        // Update the cart's coupon discount and totals
        $cart->coupon_discount += $discountValue;
        $cart->coupon_id = $coupon->id;  // Update the coupon_id on the cart
        $cart->save();

        // No need to create CartItemCoupon when scope is 'ALL'
        $this->updateCartTotals($cart);
    }

    /**
     * Check if a product is eligible for the coupon.
     *
     * @param Coupon $coupon
     * @param CartItem $cartItem
     * @return bool
     */
    private function isProductEligibleForCoupon(Coupon $coupon, CartItem $cartItem)
    {
        // If the coupon applies to all products
        if ($coupon->scope === CouponScopeEnum::ALL) {
            return true;
        }

        // Check if the coupon applies to a specific product or category
        if ($coupon->scope === 'PRODUCT' && $coupon->products->contains($cartItem->product_id)) {
            return true;
        }

        if ($coupon->scope === 'CATEGORY' && $cartItem->product->category->id === $coupon->category_id) {
            return true;
        }

        return false;
    }

    /**
     * Calculate the discount based on the coupon type (percentage or fixed amount).
     *
     * @param Coupon $coupon
     * @param CartItem|array $cartItem
     * @return float
     */
    private function calculateDiscount(Coupon $coupon, $cartItem)
    {
        // If scope is 'ALL', calculate based on the entire cart
        if (is_array($cartItem)) {
            $total = 0;
            foreach ($cartItem as $item) {
                $product = $item->product;
                $price = $this->getPrice($product);
                $total += $price * $item->quantity;
            }
            return $this->calculateDiscountAmount($coupon, $total);
        }

        // For individual cart item
        $product = $cartItem->product;
        $price = $this->getPrice($product);

        return $this->calculateDiscountAmount($coupon, $price * $cartItem->quantity);
    }

    /**
     * Calculate the discount amount based on percentage or fixed amount.
     *
     * @param Coupon $coupon
     * @param float $amount
     * @return float
     */
    private function calculateDiscountAmount(Coupon $coupon, $amount)
    {
        if ($coupon->type === 'percentage') {
            // Calculate percentage discount
            return ($coupon->value / 100) * $amount;
        } else {
            // Fixed amount discount
            return $coupon->value;
        }
    }

    /**
     * Get the price of a product, considering sale price if applicable.
     *
     * @param Product $product
     * @return float
     */
    private function getPrice(Product $product)
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

    /**
     * Update the subtotal and total of the cart.
     *
     * @param Cart $cart
     * @return void
     */
    private function updateCartTotals(Cart $cart)
    {
        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        $subtotal = 0;

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;
            $price = $this->getPrice($product);
            $subtotal += $cartItem->quantity * $price;
        }

        $total = $subtotal - $cart->coupon_discount;

        $cart->update([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }
}
