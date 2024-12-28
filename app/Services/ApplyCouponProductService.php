<?php

namespace App\Services;

use App\Enums\CouponScopeEnum;
use App\Models\Backend\Product\Product;
use App\Models\Cart;
use App\Models\Cart\CartItem;
use App\Models\CartItemCoupon;
use App\Models\Coupon;
use Exception;
use Illuminate\Support\Facades\DB;

class ApplyCouponProductService
{
    public function applyCoupon(array $validatedData)
    {
        DB::beginTransaction();

        try {
            $couponCode = $validatedData['coupon_code'];
            $userId = $validatedData['user_id'];

            // Retrieve the coupon from the database
            $coupon = Coupon::where('code', $couponCode)->firstOrFail();

            // Validate coupon
            if (!$coupon->is_active) {
                DB::rollBack();
                return 'Coupon is not active';
            }

            $now = now();
            if ($now < $coupon->valid_from || $now > $coupon->valid_to) {
                DB::rollBack();
                return 'Coupon is not valid at this time';
            }

            if ($coupon->max_uses != null && $coupon->usage_limit_per_user < $coupon->usage_count) {
                DB::rollBack();
                return 'Coupon has reached the maximum usage limit';
            }

            $isApplied = false;
            $cart = Cart::where('user_id', $userId)->where('is_active', true)->first();

            if (!$cart) {
                DB::rollBack();
                return 'No active cart found for this user';
            }

            $cartItems = CartItem::where('cart_id', $cart->id)->get();
            $totalDiscountValue = 0; // To accumulate total discount value for the cart

            // Loop through cart items and apply coupon if applicable
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;
                $isProductEligible = $this->isProductEligibleForCoupon($coupon, $cartItem);

                if ($isProductEligible) {
                    $discountValue = $this->calculateDiscount($coupon, $cartItem); // Calculate for a single cart item
                    // Add entry in CartItemCoupon
                    CartItemCoupon::create([
                        'coupon_id' => $coupon->id,
                        'cart_item_id' => $cartItem->id,
                        'value' => $discountValue,
                    ]);

                    // Accumulate the discount value for the cart totals
                    $totalDiscountValue += $discountValue;

                    $isApplied = true;
                }
            }

            // Increment the usage count of the coupon
            $coupon->increment('usage_count');

            // Call applyCouponToCart to update the cart's total with the accumulated discount and associate coupon_id with the cart
            if ($isApplied) {
                $this->applyCouponToCart($cart, $coupon, $totalDiscountValue);
            }

            DB::commit();

            return $isApplied ? 'Coupon applied successfully' : 'Coupon not applicable to any products in your cart';
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
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
