<?php

namespace App\Services;

use App\Models\Backend\Product\Product;
use App\Models\Backend\Shipping\ShippingCharge;
use App\Models\Backend\Shipping\ShippingMethod;
use App\Traits\UnitConversion;
use Illuminate\Support\Facades\Auth;

class ShippingChargeService
{
    use UnitConversion;
    private $shippingChargeClasses;

    public function __construct()
    {
        $this->shippingChargeClasses = config('shipping.charge_classes');
    }

    public function searchShippingCharges($shippingClass, $shippingMethod, $per_page)
    {
        $query = ShippingCharge::query();

        if (!empty($shippingClass)) {
            $query->where('shipping_class', $shippingClass);
        }

        if (!empty($shippingMethod)) {
            $query->where('shipping_method_id', $shippingMethod);
        }
        return $query->paginate($per_page);
    }

    private function calculateDimensionalWeight(float $length = 0, float $width = 0, float $height = 0, $dimensionalWeightFactor): float
    {
        $dimensionalWeight = ($this->convertLengthTo($length, 'm', 'cm') * $this->convertLengthTo($width, 'm', 'cm') * $this->convertLengthTo($height, 'm', 'cm')) / 5000;
        $dimensionalWeight = $this->convertWeightTo($dimensionalWeight, 'kg', 'gm');

        if ($dimensionalWeightFactor > $dimensionalWeight) {
            $dimensionalWeight = $dimensionalWeightFactor;
        }

        return $dimensionalWeight;
    }

    private function findMatchingClass(float $dimensionalWeight): ?array
    {
        foreach ($this->shippingChargeClasses as $className => $classData) {
            foreach ($classData as $criteria) {
                if ($dimensionalWeight >= $criteria['from_weight'] && $dimensionalWeight <= $criteria['to_weight']) {
                    return $criteria;
                }
            }
        }

        return null;
    }

    private function getDefaultClass(): ?array
    {
        foreach ($this->shippingChargeClasses as $className => $classData) {
            foreach ($classData as $criteria) {
                if (isset($criteria['default']) && $criteria['default']) {
                    return $criteria;
                }
            }
        }

        return null;
    }

    private function calculateCharge(array $matchingClass): float
    {
        // Calculate the shipping charge based on the matching class data
        // Implement your calculation logic here, e.g., based on weight, distance, carrier rates, etc.
        // For demonstration purposes, I'll return a fixed value of $10 for the shipping charge.
        return 10.0;
    }
    public function getShippingMethodByName($name)
    {
        return ShippingMethod::withName($name)->whereIsActive(1)->first();
    }
    public function getPrice(Product $product)
    {
        $currentDate = now();
        if (
            $product->sale_price &&
            $product->sale_start_date &&
            $product->sale_end_date &&
            $product->sale_start_date <= $currentDate &&
            $product->sale_end_date >= $currentDate
        ) {
            return $product->sale_price;
        }

        return $product->your_price;
    }

    public function calculateShippingCharges(Product $product, $quantity)
    {
        // dd(count($product));
        $totalShippingCharge = 0;
        $freeShippingMethod = $this->getShippingMethodByName('Free');
        $cashOnDelivery = $this->getShippingMethodByName('Cash On Delivery');
        $product_price = $this->getPrice($product);
        // Calculate total area based on package dimensions
        $packageHeight = $product->ProductMoreDetail->package_height ?? 0;
        $packageLength = $product->ProductMoreDetail->package_length ?? 0;
        $packageWidth = $product->ProductMoreDetail->package_width ?? 0;
        $totalWeight = $product->ProductMoreDetail->package_weight ?? 0; // Package weight

        // Calculate the dimensional weight
        $dimensionalWeight = $this->calculateDimensionalWeight($packageLength, $packageWidth, $packageHeight, $totalWeight);

        // Get the class that matches the criteria
        $matchingClass = $this->findMatchingClass($dimensionalWeight);

        if (!$matchingClass) {
            $matchingClass['name'] = null;
        }
        $shippingMethodId = "eef9baf0-75a5-11ee-93d1-3cecef4d4f08";
        // Calculate regular shipping charges
        $shipping_charge = ShippingCharge::where('shipping_method_id', $shippingMethodId)
            ->where('shipping_class', $matchingClass['name'])
            ->where('min_quantity', '<=', $quantity)
            ->where('max_quantity', '>=', $quantity)
            ->first();

        if (($shipping_charge && $shipping_charge->free_shipping != 'no') || ($shipping_charge && $shipping_charge->minimum_amount_for_free_shipping && (($product_price * $quantity)>= $shipping_charge->minimum_amount_for_free_shipping))) {
            // return 0;
        }
        // dd($shipping_charge);
        return  $shipping_charge->charge_1 ?? 0;
    }

    public function getAllShippingMethods()
    {
        return ShippingMethod::get();
    }

    public function getAllShippingCharges()
    {
        return ShippingCharge::with(['shippingMethod'])->paginate(10);
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
        $shippingCharge = ShippingCharge::find($id);
        $shippingCharge->update($data);
    }

    public function deleteShippingCharge($id)
    {
        $shippingCharge = ShippingCharge::findOrFail($id);
        $shippingCharge->delete();
    }
}
