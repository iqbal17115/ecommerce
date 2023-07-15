<?php
namespace App\Services;

use App\Models\Backend\Shipping\ShippingCharge;
use App\Models\Backend\Shipping\ShippingClass;
use App\Models\Backend\Shipping\ShippingMethod;

class ShippingChargeService
{
    public function getAllShippingClasses()
    {
        return ShippingClass::get();
    }

    public function getAllShippingMethods()
    {
        return ShippingMethod::get();
    }

    public function getAllShippingCharges()
    {
        return ShippingCharge::with(['shippingMethod', 'shippingClass'])->get();
    }

    public function createShippingCharge(array $data)
    {
        ShippingCharge::create($data);
    }

    public function getShippingChargeById($id)
    {
        return ShippingCharge::findOrFail($id);
    }

    public function updateShippingCharge(array $data, $id)
    {
        $shippingCharge = ShippingCharge::findOrFail($id);
        $shippingCharge->update($data);
    }

    public function deleteShippingCharge($id)
    {
        $shippingCharge = ShippingCharge::findOrFail($id);
        $shippingCharge->delete();
    }
}
