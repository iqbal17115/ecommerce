<?php
namespace App\Services;

use App\Models\Backend\Shipping\ShippingMethod;

class ShippingMethodService
{
    public function updateShippingMethodStatus(ShippingMethod $shippingMethod, $status)
    {
        $shippingMethod->is_active = $status;
        $shippingMethod->update();
    }
    public function getShippingMethodByName($name)
    {
        return ShippingMethod::withName($name)->first();
    }

    public function updateShippingMethod(ShippingMethod $shippingMethod, $data)
    {
        $shippingMethod->update($data);
    }
}
