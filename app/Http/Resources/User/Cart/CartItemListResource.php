<?php

namespace App\Http\Resources\User\Cart;

use App\Http\Resources\CurrencyResource;
use App\Models\Backend\Currency\Currency;
use App\Services\ShippingChargeService;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shippingCharge = $this->calculateShippingCharge();
        $activeCurrency = Currency::where('is_active', 1)->first();
        
        return [
            "id" => $this->id,
            "product_info" => CartProductDetailResource::make($this?->product),
            "quantity" => (int)$this->quantity,
            "shipping_charge" => $shippingCharge ?? 0,
            "coupon_discount" => (float)$this?->cart_item_coupon?->value ?? 0,
            "is_active" => $this->is_active,
            "variations" => $this?->productVariation?->productVariationAttributes ?CartProductVariationResource::collection($this?->productVariation?->productVariationAttributes) : [],
            "active_currency" => CurrencyResource::make($activeCurrency),
            "vendor_name" => $this->product?->user?->name,
        ];
    }

    private function calculateShippingCharge()
    {
        $shippingService = new ShippingChargeService();
        return $shippingService->calculateShippingCharges($this->product, $this->quantity);
    }
}
