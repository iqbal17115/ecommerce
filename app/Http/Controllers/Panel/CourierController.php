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
            ])->get(config('services.steadfast.url') . "/print/{$consignmentId}");
            
            // Debug log
            Log::info('Steadfast print response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if (! $response->successful()) {
                return response()->json([
                    'status' => $response->status(),
                    'message' => 'Failed to fetch invoice/label',
                    'body' => $response->body(),
                ], $response->status());
            }

            // Assuming API returns PDF or file URL
            $contentType = $response->header('Content-Type');

            if ($contentType === 'application/pdf') {
                // Return PDF file as download
                return response($response->body(), 200)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', "inline; filename=consignment_{$consignmentId}.pdf");
            }

            // If API returns JSON with URL
            $data = $response->json();
            if (isset($data['label_url'])) {
                return redirect($data['label_url']);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Invoice fetched successfully',
                'data' => $data,
            ]);

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
