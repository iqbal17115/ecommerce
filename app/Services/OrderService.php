<?php

namespace App\Services;

use App\Models\FrontEnd\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    /**
     * Get Products By Type
     *
     * @param null $status
     * @param null $limit
     * @return array|Collection
     */
    public function getOrdersByStatus($status = null, $limit = null): \Illuminate\Support\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Order::when($status !== null, function ($query) use ($status) {
            return $query->whereIn("status", $status);
        })
            ->latest('created_at');

        if ($limit !== null) {
            return $query->paginate($limit);
        }

        return $query->get();
    }


    public function deleteOrder(Order $order)
    {
        // Delete the order
        $order->delete();

        // You can also delete associated order details if needed
        $order->OrderDetail()->delete();
    }
}
