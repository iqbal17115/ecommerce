<?php

namespace App\Services;

use App\Models\FrontEnd\Order;

class OrderService
{
    public function deleteOrder(Order $order)
    {
        // Delete the order
        $order->delete();

        // You can also delete associated order details if needed
        $order->OrderDetail()->delete();
    }
}
