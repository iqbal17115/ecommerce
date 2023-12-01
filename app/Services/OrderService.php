<?php

namespace App\Services;

use App\Models\FrontEnd\Order;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Store order
     *
     * @return Order
     * @throws Exception
     */
    public function store(array $validatedData): Order
    {
        DB::beginTransaction();
        try {

            DB::commit();

            return $order;
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Get Products By Type
     *
     * @param  $status
     * @param  $limit
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
