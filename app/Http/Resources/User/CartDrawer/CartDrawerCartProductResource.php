<?php

namespace App\Http\Resources\User\CartDrawer;

use Illuminate\Http\Resources\Json\JsonResource;

class CartDrawerCartProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $productPrice = $this->calculateProductPrice();

        return [
            "id" => $this->id,
            "name" => $this->name,
            "image_url" => $this->getFirstProductImage() ? asset('storage/product_photo/' . $this->getFirstProductImage()) : '',
            "brand_name" => $this?->Brand?->name,
            "product_price" => (float)$productPrice,
        ];
    }

    protected function calculateProductPrice()
    {
        if ($this->isOnSale()) {
            return $this->sale_price;
        }

        return $this->your_price;
    }

    protected function isOnSale()
    {
        $currentDate = now();

        return ($this->sale_price &&
            $this->sale_start_date &&
            $this->sale_end_date &&
            $this->sale_start_date <= $currentDate &&
            $this->sale_end_date >= $currentDate
        );
    }

    protected function getFirstProductImage()
    {
        return $this->ProductImage?->first()?->image;
    }
}
