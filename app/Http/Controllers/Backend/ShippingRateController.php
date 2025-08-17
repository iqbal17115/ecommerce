<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Shipping\ShippingRateStoreRequest;
use App\Http\Requests\AdminPanel\Shipping\ShippingRateUpdateRequest;
use App\Http\Resources\AdminPanel\Shipping\ShippingRateResource;
use App\Services\ShippingPricingService;
use Exception;
use Illuminate\Http\JsonResponse;

class ShippingRateController extends Controller
{
    public function __construct(private ShippingPricingService $service) {}

    public function index(): JsonResponse
    {
        try {
            $zoneId = request('shipping_zone_id');
            $rates = $this->service->listRates($zoneId);
            return Message::success(null, ShippingRateResource::collection($rates));
        } catch (Exception $e) {
            return Message::error($e->getMessage());
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $rate = \App\Models\ShippingRate::findOrFail($id);
            return Message::success(null, new ShippingRateResource($rate));
        } catch (Exception $e) {
            return Message::error($e->getMessage());
        }
    }

    public function store(ShippingRateStoreRequest $request): JsonResponse
    {
        try {
            $rate = $this->service->createRate($request->validated());
            return Message::success('Shipping rate created successfully.', new ShippingRateResource($rate));
        } catch (Exception $e) {
            return Message::error($e->getMessage());
        }
    }

    public function update(string $id, ShippingRateUpdateRequest $request): JsonResponse
    {
        try {
            $rate = $this->service->updateRate($id, $request->validated());
            return Message::success('Shipping rate updated successfully.', new ShippingRateResource($rate));
        } catch (Exception $e) {
            return Message::error($e->getMessage());
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $this->service->deleteRate($id);
            return Message::success('Shipping rate deleted successfully.');
        } catch (Exception $e) {
            return Message::error($e->getMessage());
        }
    }
}
