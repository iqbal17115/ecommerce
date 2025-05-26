<?php

namespace App\Http\Resources\User\Checkout\Cart;

use App\Services\ShippingChargeService;
use App\Http\Resources\CurrencyResource;
use App\Models\Backend\Currency\Currency;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

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
        $cacheKey = 'cart_info_' . $this->id; // Assuming $this->id is unique to each instance

        // Check if the cart info is already in the session
        $cartInfo = session($cacheKey);

        $shippingService = new ShippingChargeService();
        $shippingCharge = $shippingService->calculateShippingCharges($this->product, $this->quantity);

        $activeCurrency = Currency::where('is_active', 1)->first();

        // Create an array with all the information
        $cartInfo = [
            "id" => $this->id,
            "product_info" => new CartProductDetailResource($this->product),
            "product_variation_id" => $this->product_variation_id,
            "variations" => $this?->productVariation?->productVariationAttributes ? ActiveCartItemProductVariationResource::collection($this?->productVariation?->productVariationAttributes) : [],
            "quantity" => $this->quantity,
            "shipping_charge" => $shippingCharge,
            "coupon_discount" => (float)$this?->cart_item_coupon?->value ?? 0,
            "active_currency" => new CurrencyResource($activeCurrency),
        ];

        return $cartInfo;
    }
}
