<?php

namespace App\Http\Resources\User\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            "product_name" => $this?->Product?->name,
            "unit_price" => $this->unit_price,
            "quantity" => $this->quantity,
            "total_amount" => $this->unit_price * $this->quantity,
            "image" => $this->getProductImageUrl()
        ];
    }

    /**
     * Get the full URL of the product image.
     */
    private function getProductImageUrl()
    {
        return $this?->Product?->ProductMainImage?->image
            ? asset('storage/' . $this->Product->ProductMainImage->image)
            : null;
    }
}
