<?php

namespace App\Services;

use App\Models\CourierShipment;
use App\Models\FrontEnd\Order;
use Carbon\Carbon;

class OrderCourierService
{
    public function send(Order $order, array $data): array
    {
        // Check if order already sent to this courier
        $existingShipment = CourierShipment::where('order_id', $order->id)
            ->where('courier_name', $data['courier'])
            ->whereNotIn('status', ['canceled', 'failed'])
            ->first();

        if ($existingShipment) {
            return [
                'error' => true,
                'message' => 'Order has already been sent to this courier with tracking code: ' . $existingShipment->tracking_code,
            ];
        }

        // Get courier
        $courier = CourierFactory::make('steadfast');

        // Build item description
        $itemDescription = $order->OrderDetail->map(function ($detail) {
            $productName = $detail?->Product?->name ?? '';

            $variationAttributes = $detail?->productVariation?->productVariationAttributes
                ->map(function ($attr) {
                    $attributeName = $attr?->attributeValue?->attribute->name ?? '';
                    $value = $attr?->attributeValue?->value ?? '';
                    return "{$attributeName}: {$value}";
                })
                ->implode(', ');

            return "{$productName} ({$variationAttributes}) x {$detail->quantity}";
        })->implode(' | ');

        $recipientAddress = trim(
            ($order?->orderAddress?->instruction ?? '') . ', ' .
                ($order?->orderAddress?->upazila_name ?? '') . ', ' .
                ($order?->orderAddress?->district_name ?? '') . ', ' .
                ($order?->orderAddress?->division_name ?? ''),
            ', '
        );

        // Payload for courier API
        $payload = [
            "invoice"           => $order->code,
            "recipient_name"    => $order?->orderAddress?->name,
            "recipient_phone"   => $order?->orderAddress?->mobile,
            "recipient_address" => $recipientAddress,
            "alternative_phone" => $order?->orderAddress?->optional_mobile,
            "item_description"  => $itemDescription,
            "cod_amount"        => $order->payable_amount,
            "delivery_date"     => Carbon::parse($data['dispatchDate'] ?? now())->format('d-m-Y'),
            "note"              => $order?->orderAddress?->instruction,
        ];

        $response = $courier->createOrder($payload);

        if (!empty($response['error'])) {
            return [
                'error'   => true,
                'message' => $response['message'] ?? 'Courier API failed',
            ];
        }

        // Store courier shipment record
        CourierShipment::create([
            'order_id'       => $order->id,
            'courier_name'   => $data['courier'],
            'tracking_code'  => $response['consignment']['tracking_code'] ?? $data['trackingId'] ?? null,
            'consignment_id' => $response['consignment']['consignment_id'] ?? null,
            'status'         => $response['status'] ?? 'sent',
            'payload'        => json_encode($payload),
            'response'       => json_encode($response),
            'dispatched_at'  => $data['dispatchDate'] ?? now(),
        ]);

        // Optionally, update main order for quick reference
        $order->update([
            'courier'             => $data['courier'],
            'shipping_method'     => $data['shippingMethod'],
            'courier_tracking_id' => $response['consignment']['consignment_id'] ?? $data['trackingId'] ?? null,
            'courier_status'      => $response['status'] ?? 'sent',
            'dispatch_date'       => $data['dispatchDate'] ?? null,
        ]);

        return [
            'success' => true,
            'data'    => $response,
            'message' => 'Order sent to ' . ucfirst($data['courier']) . ' successfully!',
        ];
    }
}
