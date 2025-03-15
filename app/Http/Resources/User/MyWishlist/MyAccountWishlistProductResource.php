<?php

namespace App\Http\Resources\User\MyWishlist;

use App\Models\Cart\CartItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MyAccountWishlistProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "image_url" => $this->getFirstProductImage() ? asset('storage/product_photo/' . $this->getFirstProductImage()) : '',
            "currency" => "৳",
            "product_price" => (float) $this->calculateProductPrice() ?? 0,
            "already_added" => CartItem::whereUserId(Auth::user()->id)->where("product_id", $this->id)->first() ? true : false,
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
