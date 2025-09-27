<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;
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
     * Print invoice/label for a consignment
     */
    public function printInvoice($consignmentId)
    {
        try {
            $response = Http::withHeaders([
                'Api-Key'    => config('services.steadfast.api_key'),
                'Secret-Key' => config('services.steadfast.secret_key'),
            ])->get("https://portal.steadfast.com.bd/api/v1/print_label/{$consignmentId}");

            return response($response->body(), 200)
        ->header('Content-Type', 'application/pdf');

        } catch (\Exception $ex) {
            Log::error('Steadfast print error: ' . $ex->getMessage(), [
                'consignment_id' => $consignmentId
            ]);

            return response()->json([
                'status' => 500,
                'message' => 'Error fetching invoice/label',
                'error' => $ex->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
