<?php

namespace App\Services;

use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\DB;

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

    public function updateOrderItems(Order $order, array $data)
    {
        DB::transaction(function () use ($order, $data) {
            // Update shipping charge
            $order->shipping_charge = $data['shipping_charge'] ?? $order->shipping_charge;
            $order->save();

            foreach ($data['items'] as $item) {
                $orderDetail = OrderDetail::findOrFail($item['id']);
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->unit_price = $item['unit_price'];
                $orderDetail->save();
            }

            // Recalculate total amount
            $order->total_amount = $order->OrderDetail->sum(fn($d) => $d->quantity * $d->unit_price);
            $order->payable_amount = $order->total_amount + $order->shipping_charge - $order->discount;
            $order->save();
        });

        return $order;
    }
}
