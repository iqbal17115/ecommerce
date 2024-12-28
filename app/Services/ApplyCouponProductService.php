<?php

namespace App\Services;

use App\Enums\CouponScopeEnum;
use App\Models\Backend\Product\Product;
use App\Models\Cart\CartItem;
use App\Models\CartItemCoupon;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Models\CouponUserUsage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ApplyCouponProductService
{
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

            if ($coupon->max_uses !== null && $coupon->usage_count >= $coupon->max_uses) {
                DB::rollBack();
                return 'Coupon has reached the maximum usage limit';
            }

            $isApplied = false;
            $cartItems = CartItem::where('user_id', $userId)->where('is_active', 1)->get();

            if ($coupon->scope === CouponScopeEnum::ALL) {
                // Global coupon application
                foreach ($cartItems as $cartItem) {
                    $discountValue = $coupon->type === 'percentage'
                        ? ($coupon->value / 100) * ($this->getPrice($cartItem->product) * $cartItem->quantity)
                        : $coupon->value;

                    // Add entry in CartItemCoupon
                    CartItemCoupon::create([
                        'coupon_id' => $coupon->id,
                        'cart_item_id' => $cartItem->id,
                        'value' => $discountValue,
                    ]);

                    $isApplied = true;
                }

                // Add entry in CouponUserUsage
                CouponUserUsage::create([
                    'user_id' => $userId,
                    'coupon_id' => $coupon->id,
                    'order_id' => null,
                    'product_id' => null,
                    'value' => $coupon->type === 'percentage'
                        ? ($coupon->value / 100) * $this->getCartTotal($userId)
                        : $coupon->value,
                ]);
            } else {
                // Specific product/category coupon
                foreach ($cartItems as $cartItem) {
                    $isProductAssigned = $this->isProductEligibleForCoupon($coupon, $cartItem);

                    if ($isProductAssigned) {
                        $discountValue = $coupon->type === 'percentage'
                            ? ($coupon->value / 100) * ($this->getPrice($cartItem->product) * $cartItem->quantity)
                            : $coupon->value;

                        // Add entry in CartItemCoupon
                        CartItemCoupon::create([
                            'coupon_id' => $coupon->id,
                            'cart_item_id' => $cartItem->id,
                            'value' => $discountValue,
                        ]);

                        // Add entry in CouponUserUsage
                        CouponUserUsage::create([
                            'user_id' => $userId,
                            'coupon_id' => $coupon->id,
                            'order_id' => null,
                            'product_id' => $cartItem->product_id,
                            'value' => $discountValue,
                        ]);

                        $isApplied = true;
                    }
                }
            }

            $coupon->increment('usage_count');
            DB::commit();

            return $isApplied ? 'Coupon applied successfully' : 'Coupon not applicable to any products in your cart';
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * Check if a product is eligible for a coupon.
     *
     * @param Coupon $coupon
     * @param CartItem $cartItem
     * @return bool
     */
    protected function isProductEligibleForCoupon(Coupon $coupon, CartItem $cartItem)
    {
        if ($coupon->scope === CouponScopeEnum::SPECIFIC_PRODUCTS) {
            return CouponProduct::where('coupon_id', $coupon->id)
                ->where('product_id', $cartItem->product_id)
                ->exists();
        }

        if ($coupon->scope === CouponScopeEnum::SPECIFIC_CATEGORIES) {
            $productCategoryIds = $cartItem->product->categories->pluck('id')->toArray();
            return CouponCategory::where('coupon_id', $coupon->id)
                ->whereIn('category_id', $productCategoryIds)
                ->exists();
        }

        return false; // Default case, though it shouldn't be reached
    }

    /**
     * Calculate the total cart value for a user.
     *
     * @param int $userId
     * @return float
     */
    protected function getCartTotal($userId)
    {
        return CartItem::where('user_id', $userId)
            ->where('is_active', 1)
            ->get()
            ->sum(function ($cartItem) {
                return $this->getPrice($cartItem->product) * $cartItem->quantity;
            });
    }
}
