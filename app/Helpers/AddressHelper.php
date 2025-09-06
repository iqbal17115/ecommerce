<?php

namespace App\Helpers;

class AddressHelper
{
    /**
     * Get full formatted address for an order.
     *
     * @param  mixed  $order
     * @return string|null
     */
    public static function getFullAddress($order): ?string
    {
        if (!$order?->orderAddress) {
            return null;
        }

        $address = [
            $order->orderAddress?->upazila_name,
            $order->orderAddress?->district_name,
            $order->orderAddress?->division_name,
        ];

        // Filter out null/empty values and join with commas
        return implode(', ', array_filter($address));
    }
}
