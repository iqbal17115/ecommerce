<?php
namespace App\Services;

use App\Models\Backend\Product\Product;
use App\Models\Backend\Shipping\ShippingCharge;
use App\Models\Backend\Shipping\ShippingMethod;

class ShippingChargeService
{
    private $shippingChargeClasses;

    public function __construct()
    {
        $this->shippingChargeClasses = config('shipping.charge_classes');
    }

    private function calculateDimensionalWeight(float $length, float $width, float $height, $dimensionalWeightFactor): float
    {
        $dimensionalWeight = ($length * $width * $height) / $dimensionalWeightFactor;

        return $dimensionalWeight;
    }

    private function findMatchingClass(float $dimensionalWeight, float $weight): ?array
    {
        foreach ($this->shippingChargeClasses as $className => $classData) {
            foreach ($classData as $criteria) {
                if (
                    $dimensionalWeight >= $criteria['from_area'] && $dimensionalWeight <= $criteria['to_area'] &&
                    $weight >= $criteria['from_weight'] && $weight <= $criteria['to_weight']
                ) {
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
        $totalAmount = 0; // Initialize total amount to 0
        $totalShippingCharge = 0;

        foreach ($products as $productId => $productData) {
            $product = Product::find($productId);
            $quantity = $productData['quantity'];
            $shippingMethodId = 'ee1f0de6-223e-11ee-aaf7-5811220534bb';

            $totalAmount = $quantity * $product->sale_price; // Total Amount

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
            $totalArea = $packageHeight * $packageLength * $packageWidth;
            $totalWeight = $product->ProductMoreDetail->package_weight; // Package weight

            // Calculate the dimensional weight
            $dimensionalWeight = $this->calculateDimensionalWeight($packageLength, $packageWidth, $packageHeight, $totalWeight);

            // Get the class that matches the criteria
            $matchingClass = $this->findMatchingClass($dimensionalWeight, $totalWeight);
            if (!$matchingClass) {
                $matchingClass['name'] = null;
            }

            // If no matching class found, use the default class
            if (!$matchingClass) {
                $matchingClass = $this->getDefaultClass();
            }

            // Calculate regular shipping charges
            $charge = ShippingCharge::where('shipping_method_id', $shippingMethodId)
                ->where('shipping_class', $matchingClass['name'])
                ->where('from_area', '<=', $totalArea)
                ->where('to_area', '>=', $totalArea)
                ->where('from_weight', '<=', $totalWeight)
                ->where('to_weight', '>=', $totalWeight)
                ->where(function ($query) use ($quantity, $totalAmount) {
                    $query->where(function ($query) use ($quantity, $totalAmount) {
                        $query->whereNull('min_quantity')
                            ->whereNull('max_quantity');
                    })->orWhere(function ($query) use ($quantity, $totalAmount) {
                        $query->where('min_quantity', '<=', $quantity)
                            ->where('max_quantity', '>=', $quantity);
                    });
                })
                ->orderBy('from_area')
                ->orderBy('from_weight')
                ->first();

            if ($charge) {
                $totalShippingCharge += $charge->charge;
            } else {
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
        return ShippingCharge::with(['shippingMethod'])->get();
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
