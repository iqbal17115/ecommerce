<?php

namespace App\Http\Resources\User\MyCart;

use Illuminate\Http\Resources\Json\JsonResource;

class MyCartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product" => MyCartProductResource::make($this->product),
            "quantity" => $this->quantity,
            "coupon_discount" => (float)$this?->cart_item_coupon?->value ?? 0,
            "is_active" => $this->is_active
        ];
    }
}
