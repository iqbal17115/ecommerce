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

        // if ($cartInfo === null) {
        // If not in session, calculate and store in the session
        $shippingService = new ShippingChargeService();
        $shippingCharge = $shippingService->calculateShippingCharges($this->product, $this->quantity);

        $activeCurrency = Currency::where('is_active', 1)->first();

        // Create an array with all the information
        $cartInfo = [
            "id" => $this->id,
            "product_info" => new CartProductDetailResource($this->product),
            "quantity" => $this->quantity,
            "shipping_charge" => $shippingCharge,
            "active_currency" => new CurrencyResource($activeCurrency),
        ];

        // Store in the session
        session([$cacheKey => $cartInfo]);
        session(['cart_info' => $cartInfo]);
        // }

        return $cartInfo;
    }
}
