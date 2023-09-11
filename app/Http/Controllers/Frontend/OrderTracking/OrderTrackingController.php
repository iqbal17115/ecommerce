<?php

namespace App\Http\Controllers\Frontend\OrderTracking;

use App\Enums\OrderStatusEnum;
use App\Enums\OrderTrackingStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Backend\Order\OrderTracking;
use App\Models\FrontEnd\Order;

class OrderTrackingController extends Controller
{
    public function orderTracking($id) {
        $order = Order::find($id);
        $orderStatuses = OrderTrackingStatusEnum::getOrderTrackingStatus();
        $orderTrackings = OrderTracking::where('order_id', $id)->get();
        $trackingData = $orderTrackings->map(function ($item) {
            return [
                'status' => $item->status,
                'created_at' => $item->created_at->toDateTimeString(), // Format created_at as a string
            ];
        })->sortByDesc('created_at')->toArray();

       return view('ecommerce.my-account.order_tracking.track_order', compact('order', 'orderStatuses', 'trackingData'));
    }
}
