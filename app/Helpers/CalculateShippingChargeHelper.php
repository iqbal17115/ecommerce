<?php

namespace App\Helpers;

use App\Models\ShippingRate;

class CalculateShippingChargeHelper
{
    public static function calculateShippingCharge($cartItems, $shippingZoneId)
    {
        // Calculate cart totals
        $totalAmount = 0;
        $totalWeight = 0;
        $totalQty = 0;

        foreach ($cartItems as $item) {
            $product = $item->product ?? null;

            if (!$product) {
                continue;
            }

            // Calculate totals
            $totalQty += $item->quantity;
            $totalAmount += $product->price * $item->quantity;
            $totalWeight += $product->weight * $item->quantity;
        }

        // Find matching shipping rate
        $rate = ShippingRate::query()
            ->where('shipping_zone_id', $shippingZoneId)
            ->where(function ($q) use ($totalAmount) {
                $q->whereNull('min_amount')->orWhere('min_amount', '<=', $totalAmount);
            })
            ->where(function ($q) use ($totalAmount) {
                $q->whereNull('max_amount')->orWhere('max_amount', '>=', $totalAmount);
            })
            ->where(function ($q) use ($totalWeight) {
                $q->whereNull('min_weight')->orWhere('min_weight', '<=', $totalWeight);
            })
            ->where(function ($q) use ($totalWeight) {
                $q->whereNull('max_weight')->orWhere('max_weight', '>=', $totalWeight);
            })
            ->where(function ($q) use ($totalQty) {
                $q->whereNull('min_qty')->orWhere('min_qty', '<=', $totalQty);
            })
            ->where(function ($q) use ($totalQty) {
                $q->whereNull('max_qty')->orWhere('max_qty', '>=', $totalQty);
            })
            ->orderBy('rate')
            ->first();

        return $rate ? $rate->rate : 0;
    }
}
