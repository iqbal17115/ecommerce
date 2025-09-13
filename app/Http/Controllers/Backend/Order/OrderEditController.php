<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderEdit\UpdateOrderAddressRequest;
use App\Http\Resources\OrderEdit\OrderAddressResource;
use App\Models\FrontEnd\Order;
use App\Services\OrderEditService;
use Illuminate\Http\Request;

class OrderEditController extends Controller
{
    protected $orderEditService;

    public function __construct(OrderEditService $orderEditService)
    {
        $this->orderEditService = $orderEditService;
    }

    public function updateAddress(UpdateOrderAddressRequest $request, Order $order)
    {
        try {
            $address = $this->orderEditService->updateShippingAddress($order, $request->validated());

            return (new OrderAddressResource($address))
                ->additional([
                    'status' => 'success',
                    'message' => 'Shipping address updated successfully.'
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
