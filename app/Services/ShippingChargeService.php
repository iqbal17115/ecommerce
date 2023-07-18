<?php
namespace App\Services;

use App\Models\Backend\Product\Product;
use App\Models\Backend\Shipping\ShippingCharge;
use App\Models\Backend\Shipping\ShippingClass;
use App\Models\Backend\Shipping\ShippingMethod;

class ShippingChargeService
{
    public function calculateShippingCharge()
    {
        $products = session('cart');
        $totalAmount = 0; // Initialize total amount to 0
        $totalShippingCharge = 0;

        foreach ($products as $productId => $productData) {
            $product = Product::find($productId); // Find product
            $quantity = $productData['quantity'];
            $length = $product->ProductMoreDetail->package_length ?? 0; // Assuming have 'length' field in the product data
            $width = $product->ProductMoreDetail->package_width ?? 0; // Assuming have 'width' field in the product data
            $height = $product->ProductMoreDetail->package_height ?? 0; // Assuming have 'height' field in the product data
            $weight = $product->ProductMoreDetail->package_weight ?? 0;; // Assuming have 'weight' field in the product data
            $shippingMethodId = $product->shipping_method_id ?? null;
            $shippingClassId = $product->shipping_class_id ?? null;

            // Calculate the total amount for all products in the cart
            $totalAmount += $productData['sale_price'] * $quantity;

            // Check for specific product free shipping
            // if ($product && $product->isFreeShippingEligible($totalAmount)) {
            //     continue; // Skip to the next product
            // }
            // Calculate regular shipping charges for the product
            $charge = ShippingCharge::where('shipping_method_id', $shippingMethodId)
                ->where('shipping_class_id', $shippingClassId)
                ->where('from_length', '<=', $length)
                ->where('to_length', '>=', $length)
                ->where('from_width', '<=', $width)
                ->where('to_width', '>=', $width)
                ->where('from_height', '<=', $height)
                ->where('to_height', '>=', $height)
                ->where('from_weight', '<=', $weight)
                ->where('to_weight', '>=', $weight)
                ->where(function ($query) use ($quantity, $totalAmount) {
                    $query->where(function ($query) use ($quantity, $totalAmount) {
                        $query->whereNull('min_quantity')
                            ->whereNull('max_quantity')
                            ->whereNull('min_amount')
                            ->whereNull('max_amount');
                    })->orWhere(function ($query) use ($quantity, $totalAmount) {
                        $query->where('min_quantity', '<=', $quantity)
                            ->where('max_quantity', '>=', $quantity)
                            ->where('min_amount', '<=', $totalAmount)
                            ->where('max_amount', '>=', $totalAmount);
                    });
                })
                ->orderBy('from_length')
                ->orderBy('from_width')
                ->orderBy('from_height')
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
