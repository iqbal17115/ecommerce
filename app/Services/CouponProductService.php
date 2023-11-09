<?php

namespace App\Services;

use App\Enums\TransactionType;
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
     * @param $request
     * @throws Exception
     */
    public function store(array $validatedData)
    {
        DB::beginTransaction();
        try {

            $couponId = $validatedData['coupon_id'];
            $productIds = $validatedData['product_id'];
    
            // Get the current product associations for the given coupon
            $currentProductIds = CouponProduct::where('coupon_id', $couponId)->pluck('product_id')->all();

            // Determine the product IDs to add and remove
            $productIdsToAdd = array_diff($productIds, $currentProductIds);
            $productIdsToRemove = array_diff($currentProductIds, $productIds);

            // Add new product associations
            foreach ($productIdsToAdd as $productId) {
                CouponProduct::create([
                    'coupon_id' => $couponId,
                    'product_id' => $productId,
                ]);
            }
    
            // Remove product associations that are no longer needed
            CouponProduct::where('coupon_id', $couponId)
                ->whereIn('product_id', [$productIdsToRemove])
                ->delete();

            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }
}