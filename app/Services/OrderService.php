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
    public function store(array $validatedData, $cartInfo): Order
    {
        // Retrieve all cart information from the session
        $allCartInfo = session('cart_info');

        // Convert $allCartInfo to a collection
        $cartCollection = collect($allCartInfo);

        $shippingChargeSum = collect($cartCollection['data'])->sum('shipping_charge');

        // Create an order
        $order = new Order();
        $order->user_id = auth()->id(); // Assuming you have user authentication
        $order->order_date = now();
        $order->total_amount = 1111;
        $order->other_amount = 11;
        $order->discount = 1;
        $order->shipping_charge = $shippingChargeSum;
        $order->vat = 1;
        $order->payable_amount = 11;
        $order->note = $validatedData['note'];
        $order->coupon_code_id = $validatedData['coupon_code_id'];
        $order->status = 'pending';
        $order->is_active = 1;
        $order->save();

        foreach ($cartCollection['data'] as $aaa) {
        }

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
