<?php

namespace App\Services;

use App\Models\Address\Address;
use App\Models\Cart\CartItem;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use App\Models\OrderAddress;
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
        DB::beginTransaction();
        try {
            // Retrieve all cart information from the session
            $allCartInfo = session('cart_info');

            // Convert $allCartInfo to a collection
            $cartCollection = collect($allCartInfo);

            $shippingChargeSum = collect($cartCollection['data'])->sum('shipping_charge');
            $couponDiscount = collect($cartCollection['data'])->sum('coupon_discount');
            $totalAmount = 0;

            foreach ($cartCollection['data'] as $cartItem) {
                $totalAmount += collect($cartItem['product_info'])['product_price'] * $cartItem['quantity'];
            }

            // Create an order
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_date = now();
            $order->total_amount = $totalAmount;
            $order->other_amount = 0;
            $order->discount = $couponDiscount;
            $order->shipping_charge = $shippingChargeSum;
            $order->vat = 0;
            $order->payable_amount = ($totalAmount + $shippingChargeSum - $couponDiscount);
            $order->note = 'Order';
            $order->status = 'pending';
            $order->is_active = 1;
            $order->save();

            foreach ($cartCollection['data'] as $cartItem) {
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cartItem['product_info']['id'];
                $orderDetails->unit_price = collect($cartItem['product_info'])['product_price'];
                $orderDetails->quantity = $cartItem['quantity'];
                $orderDetails->save();
            }


            $address = Address::find($validatedData['address_id']);

            $orderAddress = new OrderAddress();
            $orderAddress->order_id = $order->id;
            $orderAddress->name = $address->name;
            $orderAddress->instruction = $address->instruction;
            $orderAddress->mobile = $address->mobile;
            $orderAddress->optional_mobile = $address->optional_mobile;
            $orderAddress->street_address = $address->street_address;
            $orderAddress->building_name = $address->building_name;
            $orderAddress->nearest_landmark = $address->nearest_landmark;
            $orderAddress->type = $address->type;
            $orderAddress->country_name = $address?->country?->name;
            $orderAddress->division_name = $address?->division?->name;
            $orderAddress->district_name = $address?->district?->name;
            $orderAddress->upazila_name = $address?->upazila?->name;
            $orderAddress->save();

            // Delete CartItem records for the current user
            CartItem::where('user_id', auth()->id())->delete();

            // Remove the cart_info session
            session()->forget('cart_info');
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
