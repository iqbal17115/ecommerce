<?php

namespace App\Services\Couriers;

use App\Contracts\CourierInterface;
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
}
