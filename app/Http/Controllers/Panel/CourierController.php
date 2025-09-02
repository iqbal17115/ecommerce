<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;
use App\Services\CourierFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function sendOrder(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $courier = CourierFactory::make('steadfast');

        $itemDescription = $order->OrderDetail->map(function ($detail) {
            $productName = $detail?->Product?->name ?? '';

            // Collect variation attributes (like Color: Red, Size: XL)
            $variationAttributes = $detail?->productVariation?->productVariationAttributes
                ->map(function ($attr) {
                    $attributeName = $attr?->attributeValue?->attribute->name ?? '';
                    $value = $attr?->attributeValue?->value ?? '';
                    return "{$attributeName}: {$value}";
                })
                ->implode(', ');

            return "{$productName} ({$variationAttributes}) x {$detail->quantity}";
        })->implode(' | ');



        $payload =  [
            "invoice" => $order->code,
            "recipient_name" => $order?->orderAddress?->name,
            "recipient_phone" => $order?->orderAddress?->mobile,
            "recipient_address" => $order?->orderAddress?->instruction,
            "alternative_phone" => $order?->orderAddress?->optional_mobile,
            "item_description" => $itemDescription,
            "cod_amount" => $order->payable_amount,
            "delivery_date" => Carbon::parse($request->dispatchDate ?? now())->format('d-m-Y'),
            "note" => $order?->orderAddress?->instruction,
        ];

        $response = $courier->createOrder($payload);

        if (!empty($response['error'])) {
            return response()->json([
                'error' => true,
                'message' => $response['message'] ?? 'Courier API failed',
            ], 422);
        }

        $order->update([
            'courier'             => $request->courier,
            'shipping_method'     => $request->shippingMethod,
            'courier_tracking_id' => $response['consignment']['consignment_id'] ?? $request->trackingId,
            'courier_status'      => $response['status'] ?? 'sent',
            'dispatch_date'       => $request->dispatchDate,
        ]);

        return response()->json([
            'success' => true,
            'data' => $response,
            'message' => 'Order sent to ' . ucfirst($request->courier) . ' successfully!',
        ]);
    }
}
