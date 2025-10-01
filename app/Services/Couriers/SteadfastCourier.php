<?php

namespace App\Services\Couriers;

use App\Contracts\CourierInterface;
use App\Models\CourierShipment;
use Illuminate\Support\Facades\Http;

class SteadfastCourier implements CourierInterface
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $secretKey;

    public function __construct()
    {
        $this->baseUrl   = config('services.steadfast.url');
        $this->apiKey    = config('services.steadfast.api_key');
        $this->secretKey = config('services.steadfast.secret_key');
    }

    public function createOrder(array $orderData): array
    {
        $response = Http::withHeaders([
            'Api-Key'    => $this->apiKey,
            'Secret-Key' => $this->secretKey,
        ])->post($this->baseUrl, $orderData);

        return $response->json() ?? [
            'error' => true,
            'message' => $response->body(),
            'status' => $response->status(),
        ];
    }

    /**
     * Check delivery status for a shipment
     */
    public function checkStatus(CourierShipment $shipment): array
    {
        // Decide endpoint priority
        if ($shipment->consignment_id) {
            $url = $this->baseUrl . '/status_by_cid/' . $shipment->consignment_id;
        } elseif ($shipment->tracking_code) {
            $url = $this->baseUrl . '/status_by_trackingcode/' . $shipment->tracking_code;
        } elseif ($shipment->order?->code) {
            $url = $this->baseUrl . '/status_by_invoice/' . $shipment->order->code;
        } else {
            return ['error' => true, 'message' => 'No valid identifier to check status.'];
        }

        try {
            $response = Http::withHeaders([
                'Api-Key'    => $this->apiKey,
                'Secret-Key' => $this->secretKey,
                'Content-Type' => 'application/json',
            ])->get($url);

            $data = $response->json();

            if (!isset($data['delivery_status'])) {
                return ['error' => true, 'message' => 'Invalid response from courier', 'response' => $data];
            }

            $status = $data['delivery_status'];

            // Map final statuses
            $finalStatuses = ['delivered', 'partial_delivered', 'cancelled'];

            // Update shipment
            $shipment->update([
                'status'        => $status,
                'last_synced_at' => now(),
                'is_final'      => in_array($status, $finalStatuses),
                'delivered_at'  => $status === 'delivered' ? now() : $shipment->delivered_at,
                'attempts'      => $shipment->attempts + 1,
                'status_reason' => $data['reason'] ?? null,
                'response'      => json_encode($data),
            ]);

            return ['success' => true, 'status' => $status, 'data' => $data];
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }
}
