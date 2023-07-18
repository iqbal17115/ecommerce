<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping\ShippingChargeRequest;
use App\Models\Backend\Shipping\ShippingCharge;
use App\Services\ShippingChargeService;
use Exception;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    private $shippingChargeService;

    public function __construct(ShippingChargeService $shippingChargeService)
    {
        $this->shippingChargeService = $shippingChargeService;
    }
    public function calculateShippingCharge() {
        $totalShippingCharge = $this->shippingChargeService->calculateShippingCharge();
        return response()->json(['charge' => $totalShippingCharge->getData()->charge]);
    }
    public function index()
    {
        $shippingClasses  = $this->shippingChargeService->getAllShippingClasses();
        $shippingMethods = $this->shippingChargeService->getAllShippingMethods();
        $shippingCharges = $this->shippingChargeService->getAllShippingCharges();

        return view('backend.shipping.index', compact('shippingClasses', 'shippingMethods', 'shippingCharges'));
    }

    public function create()
    {
        // Fetch any necessary data from other models if needed and pass it to the view
        $shippingClasses  = $this->shippingChargeService->getAllShippingClasses();
        $shippingMethods = $this->shippingChargeService->getAllShippingMethods();

        return view('backend.shipping.create', compact('shippingClasses', 'shippingMethods'));
    }

    public function store(ShippingChargeRequest $request)
    {
        $this->shippingChargeService->createShippingCharge($request->validated());

        return redirect()->route('shipping_charge.index')->with('success', 'Shipping charge created successfully.');
    }

    public function edit($id)
    {
        $shippingCharge = $this->shippingChargeService->getShippingChargeById($id);
        $shippingMethods = $this->shippingChargeService->getAllShippingMethods();
        $shippingClasses  = $this->shippingChargeService->getAllShippingClasses();

        return view('backend.shipping.edit', compact('shippingMethods', 'shippingClasses', 'shippingCharge'));
    }

    public function update(ShippingChargeRequest $request, $id)
    {
        $this->shippingChargeService->updateShippingCharge($request->validated(), $id);

        return redirect()->route('shipping_charge.index')->with('success', 'Shipping charge updated successfully.');
    }

    public function destroy($id)
    {
        $this->shippingChargeService->deleteShippingCharge($id);

        return redirect()->route('shipping_charge.index')->with('success', 'Shipping charge deleted successfully.');
    }
}
