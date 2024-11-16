<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Http\Controllers\Controller;
use App\Models\Backend\Shipping\ShippingMethod;
use App\Services\ShippingMethodService;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    protected $shippingMethodService;

    public function __construct(ShippingMethodService $shippingMethodService)
    {
        $this->shippingMethodService = $shippingMethodService;
    }

    public function updateStatus(Request $request, ShippingMethod $shippingMethod)
    {
        $status = $request->input('status');
        $this->shippingMethodService->updateShippingMethodStatus($shippingMethod, $status);

        return response()->json(['message' => 'Shipping method status updated successfully']);
    }

    public function setting() {
        $cashOnDeliveryMethod = $this->shippingMethodService->getShippingMethodByName('Cash On Delivery');
        $freeShippingMethod = $this->shippingMethodService->getShippingMethodByName('Free');
        return view('backend.shipping_methods.setting', compact('cashOnDeliveryMethod', 'freeShippingMethod'));
    }
    public function update(Request $request, ShippingMethod $shippingMethod) {
        $this->shippingMethodService->updateShippingMethod($shippingMethod, $request->all());
    }
    public function index()
    {
        $cashOnDeliveryMethod = $this->shippingMethodService->getShippingMethodByName('Cash On Delivery');
        $freeShippingMethod = $this->shippingMethodService->getShippingMethodByName('Free');

        return view('backend.shipping_methods.index', compact('cashOnDeliveryMethod', 'freeShippingMethod'));
    }
}
