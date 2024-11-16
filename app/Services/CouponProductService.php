<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Backend\Product\Product;
use App\Models\Coupon;
use App\Models\JournalEntry;
use App\Models\Transaction;
use App\Models\CouponProduct;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CouponProductService
{
    /**
     * Store or update Coupon product
     *
     * @param $validatedData
     * @throws Exception
     */
    public function store($validatedData, Coupon $coupon)
    {
        DB::beginTransaction();
        try {

            $couponId = $validatedData['coupon_id'];
            $productIds = explode(',', $validatedData['product_id']);

            // Check if the provided product IDs exist in the products table
            $existingProductIds = Product::whereIn('id', $productIds)->pluck('id')->toArray();

            // Only associate products that exist in the products table
            foreach ($existingProductIds as $productId) {
                CouponProduct::updateOrCreate(
                    ['coupon_id' => $couponId, 'product_id' => $productId],
                    ['coupon_id' => $couponId, 'product_id' => $productId]
                );
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }
}
