<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;
use App\Services\OrderCourierService;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function __construct(private readonly OrderCourierService $orderCourierService) {}

    public function sendOrder(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $result = $this->orderCourierService->send($order, $request->all());

        if (!empty($result['error'])) {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Failed to send order to courier',
                'data'    => $result['data'] ?? null,
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => $result['message'] ?? 'Order sent successfully',
            'data'    => [
                'courier_name'   => $order->courierShipment?->courier_name,
                'shipping_method' => $order->shipping_method,
                'tracking_code'  => $order->courierShipment?->tracking_code,
                'dispatched_at'  => $order->courierShipment?->dispatched_at,
                'estimate_date'  => $order->courierShipment?->dispatched_at, // or calculate if needed
            ]
        ]);
    }
}
