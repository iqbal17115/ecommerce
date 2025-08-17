<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Shipping\InsideOutsideStoreRequest;
use App\Http\Resources\AdminPanel\Shipping\InsideOutsideResource;
use App\Services\ShippingPricingService;
use Exception;
use Illuminate\Http\JsonResponse;

class ShippingInsideOutsideController extends Controller
{
    public function __construct(private ShippingPricingService $service) {}

    // GET /admin/shipping-inside-outside/{zoneId}
    public function showByZone(string $zoneId): JsonResponse
    {
        try {
            $row = $this->service->showInsideOutside($zoneId);
            return Message::success(null, $row ? new InsideOutsideResource($row) : null);
        } catch (Exception $e) {
            return Message::error($e->getMessage());
        }
    }

    // POST /admin/shipping-inside-outside (upsert)
    public function storeOrUpdate(InsideOutsideStoreRequest $request): JsonResponse
    {
        try {
            $row = $this->service->upsertInsideOutside($request->validated());
            return Message::success('Inside/Outside rates saved.', new InsideOutsideResource($row));
        } catch (Exception $e) {
            return Message::error($e->getMessage());
        }
    }
}
