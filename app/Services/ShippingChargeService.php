<?php

namespace App\Services;

use App\Models\ShippingCharge;

class ShippingChargeService
{
    public function calculateCharge($upazilaId, $orderAmount, $quantity)
    {
        $query = ShippingCharge::query();

        // Location filters - try the most specific to less specific
        if ($upazilaId) {
            $query->where('upazila_id', $upazilaId);
        } else {
            // If no upazila is provided, you might want to consider a default or fallback
            $query->whereNull('upazila_id');
        }

        // Filter by order amount
        // $query->where(function ($q) use ($orderAmount) {
        //     $q->whereNull('min_order_amount')->orWhere('min_order_amount', '<=', $orderAmount);
        // })->where(function ($q) use ($orderAmount) {
        //     $q->whereNull('max_order_amount')->orWhere('max_order_amount', '>=', $orderAmount);
        // });

        // Filter by quantity
        $query->where(function ($q) use ($quantity) {
            $q->whereNull('min_qty')
                ->orWhere('min_qty', '<=', $quantity);
        })->where(function ($q) use ($quantity) {
            $q->whereNull('max_qty')
                ->orWhere('max_qty', '>=', $quantity);
        });


        $charge = $query->where('is_active', 1)->orderByDesc('charge_amount')->first();

        return $charge ? (float) $charge->charge_amount : 0;
    }
}
