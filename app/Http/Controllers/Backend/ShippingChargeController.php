<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\ShippingCharge\ShippingChargeStoreRequest;
use App\Http\Requests\AdminPanel\ShippingCharge\ShippingChargeUpdateRequest;
use App\Http\Requests\ShippingCharge\ShippingChargeListRequest;
use App\Http\Resources\AdminPanel\ShippingCharge\ShippingChargeResource;
use App\Models\ShippingCharge;
use App\Services\ManageShippingChargeService;
use App\Traits\BaseModel;
use Illuminate\Http\JsonResponse;

class ShippingChargeController extends Controller
{
    use BaseModel;

    public function __construct(private readonly ManageShippingChargeService $manageShippingChargeService) {}

    // List all shipping charges
    public function index(ShippingChargeListRequest $request): bool|string
    {
        return $this->dataTable(ShippingCharge::query(), $request->all(), ShippingChargeResource::class);
    }

    // Show a single shipping charge
    public function show(string $id): JsonResponse
    {
        $shippingCharge = $this->manageShippingChargeService->getById($id);

        return response()->json([
            'results' => new ShippingChargeResource($shippingCharge),
        ]);
    }

    // Store new shipping charge
    public function store(ShippingChargeStoreRequest $request): JsonResponse
    {
        $shippingCharge = $this->manageShippingChargeService->create($request->validated());

        return response()->json([
            'message' => 'Shipping charge created successfully',
            'data' => new ShippingChargeResource($shippingCharge),
        ]);
    }

    // Update existing shipping charge
    public function update(ShippingChargeUpdateRequest $request, string $id): JsonResponse
    {
        $shippingCharge = $this->manageShippingChargeService->update($id, $request->validated());

        return response()->json([
            'message' => 'Shipping charge updated successfully',
            'data' => new ShippingChargeResource($shippingCharge),
        ]);
    }

    // Delete a shipping charge
    public function destroy($id): JsonResponse
    {
        $this->manageShippingChargeService->delete($id);

        return response()->json([
            'message' => 'Shipping charge deleted successfully',
        ]);
    }
}
