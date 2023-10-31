<?php

namespace App\Http\Resources\User\Cart;

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
        $shippingService = new ShippingChargeService();
        return [
            "id" => $this->id,
            "product_info" => new CartProductDetailResource($this->product), // Correct the relationship name to 'product'
            "quantity" => $this->quantity,
            "shipping_charge" => $shippingService->calculateShippingCharges($this->product, $this->quantity),
        ];
    }
}
