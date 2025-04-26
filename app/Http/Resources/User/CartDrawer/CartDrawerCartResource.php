<?php

namespace App\Http\Resources\User\CartDrawer;

use Illuminate\Http\Resources\Json\JsonResource;

class CartDrawerCartResource extends JsonResource
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
            'id' => $this->id,
            "product_info" => CartDrawerCartProductResource::make($this->product),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'is_active' => $this->is_active,
            "active_currency" => '৳',
        ];
    }
}
