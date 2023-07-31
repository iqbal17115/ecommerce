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

    private function calculateDimensionalWeight(float $length, float $width, float $height, $dimensionalWeightFactor): float
    {
        $dimensionalWeight = ($this->convertLengthTo($length, 'm', 'cm') * $this->convertLengthTo($width, 'm', 'cm') * $this->convertLengthTo($height, 'm', 'cm')) / 5000;
        $dimensionalWeight = $this->convertWeightTo($dimensionalWeight, 'kg', 'gm');

        if($dimensionalWeightFactor > $dimensionalWeight) {
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
    public function calculateShippingCharge()
    {
        $products = session('cart');
        $totalShippingCharge = 0;
        $shippingMethodId = 'ee1f0de6-223e-11ee-aaf7-5811220534bb';
        $inside = Auth::user()?->Contact?->Division?->id == 6 ? true : false;

        foreach ($products as $productId => $productData) {
            $product = Product::find($productId);
            $quantity = $productData['quantity'];
            // Check for specific product free shipping
            if ($productId) {
                if ($product && $product->isFreeShippingEligible()) {
                    continue; // Skip to the next product
                }
            }

            // Calculate total area based on package dimensions
            $packageHeight = $product->ProductMoreDetail->package_height;
            $packageLength = $product->ProductMoreDetail->package_length;
            $packageWidth = $product->ProductMoreDetail->package_width;
            $totalWeight = $product->ProductMoreDetail->package_weight; // Package weight

            // Calculate the dimensional weight
            $dimensionalWeight = $this->calculateDimensionalWeight($packageLength, $packageWidth, $packageHeight, $totalWeight);

            // Get the class that matches the criteria
            $matchingClass = $this->findMatchingClass($dimensionalWeight);

            if (!$matchingClass) {
                $matchingClass['name'] = null;
            }

            // If no matching class found, use the default class
            // if (!$matchingClass) {
            //     $matchingClass = $this->getDefaultClass();
            // }
            // Calculate regular shipping charges
            $shipping_charge = ShippingCharge::where('shipping_method_id', $shippingMethodId)
            ->where('shipping_class', $matchingClass['name'])
            ->where('min_quantity', '<=', $quantity)
            ->where('max_quantity', '>=', $quantity)
            ->first();

            if ($shipping_charge) {
                $totalShippingCharge += $inside == true ? $shipping_charge->charge_1 : $shipping_charge->charge_2;
            } else {

                // dd($shippingMethodId, $quantity, $shipping_charge, $dimensionalWeight, $matchingClass['name']);
                // Handle the case where no shipping charge is found for a product
                // return response()->json(['error' => 'No shipping charge found for one or more products.']);
            }

        }
        return response()->json(['charge' => $totalShippingCharge]);
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
        $shippingCharge = ShippingCharge::findOrFail($id);
        $shippingCharge->update($data);
    }

    public function deleteShippingCharge($id)
    {
        $shippingCharge = ShippingCharge::findOrFail($id);
        $shippingCharge->delete();
    }
}
