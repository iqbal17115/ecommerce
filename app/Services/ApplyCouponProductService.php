<?php

namespace App\Services;

use App\Models\Backend\Product\Product;
use App\Models\Cart\CartItem;
use App\Models\CartItemCoupon;
use App\Models\Coupon;
use App\Models\CouponProduct;
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

    /**
     * Apply Coupon
     *
     * @param $request
     * @throws Exception
     */
    public function applyCoupon(array $validatedData)
    {
        DB::beginTransaction();

        try {
            $couponCode = $validatedData['coupon_code'];
            $userId = $validatedData['user_id'];

            // Retrieve the cart items for the user
            $cartItems = CartItem::where('user_id', $userId)->where('is_active', 1)->get();

            // Retrieve the coupon from the database based on the provided code
            try {
                $coupon = Coupon::where('code', $couponCode)->firstOrFail();
            } catch (Exception $e) {
                // Coupon not found
                DB::rollBack();
                return 'Coupon not found';
            }

            // Check if the coupon is active
            if (!$coupon->is_active) {
                DB::rollBack();
                return 'Coupon is not active';
            }

            // Check if the coupon is within the valid date range
            $now = now();
            if ($now < $coupon->valid_from || $now > $coupon->valid_to) {
                DB::rollBack();
                return 'Coupon is not valid at this time';
            }

            // Check if the coupon has reached the maximum usage limit
            if ($coupon->max_uses !== null && $coupon->usage_count >= $coupon->max_uses) {
                DB::rollBack();
                return 'Coupon has reached the maximum usage limit';
            }

            // Update coupon usage count
            $coupon->increment('usage_count');
            $is_apply = false;
            // Create records in cart_item_coupons
            foreach ($cartItems as $cartItem) {
                // Check if a CartItemCoupon entry already exists for this cart item and coupon
                $existingCouponEntry = CartItemCoupon::where('coupon_id', $coupon->id)
                    ->where('cart_item_id', $cartItem->id)
                    ->first();

                    $existingCouponEntry = CartItemCoupon::where('coupon_id', $coupon->id)
                    ->where('cart_item_id', $cartItem->id)
                    ->first();

                    $isProductAssigned = CouponProduct::where('coupon_id', $coupon->id)
                    ->where('product_id', $cartItem->product_id)
                    ->exists();

                if (!$existingCouponEntry && $isProductAssigned) {
                    $discountValue = ($coupon->type === 'percentage')
                        ? ($coupon->value / 100) * ($this->getPrice($cartItem->product) * $cartItem->quantity)
                        : $coupon->value;

                    CartItemCoupon::create([
                        'coupon_id' => $coupon->id,
                        'cart_item_id' => $cartItem->id,
                        'value' => $discountValue,
                    ]);

                    $is_apply = true;
                }
            }

            // Commit the transaction
            DB::commit();

            if ($is_apply) {
                return 'Coupon applied successfully';
            } else {
                return 'Something went wrong!';
            }
            // Return a success response

        } catch (Exception $ex) {
            // Handle exceptions

            // Roll back the transaction
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }
}
