<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;
use App\Services\CourierFactory;
use App\Services\OrderCourierService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

    /**
     * Check delivery status on-demand
     */
    public function checkStatus(Request $request, $orderId)
    {
        $order = Order::with('courierShipment')->findOrFail($orderId);

        if (!$order->courierShipment) {
            return response()->json([
                'success' => false,
                'message' => 'No courier shipment found for this order.'
            ], 404);
        }

        $courier = CourierFactory::make($order->courierShipment->courier_name);

        $result = $courier->checkStatus($order->courierShipment);
dd($result);
        if (!empty($result['error'])) {
            return response()->json([
                'success' => false,
                'message' => $result['message'] ?? 'Failed to check status',
                'data'    => $result['data'] ?? null,
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'data'    => [
                'status'        => $order->courierShipment->status,
                'is_final'      => $order->courierShipment->is_final,
                'delivered_at'  => $order->courierShipment->delivered_at,
                'last_synced_at' => $order->courierShipment->last_synced_at,
                'tracking_code' => $order->courierShipment->tracking_code,
                'consignment_id' => $order->courierShipment->consignment_id,
                'response'      => json_decode($order->courierShipment->response ?? '{}'),
            ]
        ]);
    }
}
