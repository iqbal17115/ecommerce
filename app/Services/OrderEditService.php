<?php

namespace App\Services;

use App\Models\FrontEnd\Order;
use App\Models\OrderAddress;

class OrderEditService
{
    public function updateShippingAddress(Order $order, array $data)
    {
        $address = $order->orderAddress ?? new OrderAddress(['order_id' => $order->id]);

        $address->fill([
            'instruction' => $data['street'],
            'district_name' => $data['district'],
            'name' => $data['name'],
            'mobile' => $data['mobile'] ?? null,
            'optional_mobile' => $data['optional_mobile'] ?? null,
        ]);

        $address->save();

        return $address;
    }
}
