<?php

namespace App\Http\Resources\User\Shop;

use App\Http\Resources\CurrencyResource;
use App\Models\Backend\Currency\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $activeCurrency = Currency::where('is_active', 1)->first();

        return [
            "id" => $this->id,
            "product_name" => $this->name,
            "image_url" => $this->getFirstProductImage() ? asset('storage/product_photo/'.$this->getFirstProductImage()) : '',
            "your_price" => (float)$this->your_price,
            "sale_price" => (float)$this->sale_price,
            "stock_qty" => $this->stock_qty,
            "is_offer_active" => $this->offerActive(),
            'offer_percentage' =>$this->offerActive() ? round((($this->sale_price - $this->your_price) / $this->sale_price) * 100, 0) : 0,
            "active_currency" => new CurrencyResource($activeCurrency),
        ];
    }

    protected function offerActive()
    {
        if ($this->isOnSale()) {
            return true;
        }

        return false;
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
        return $this->ProductImage?->first()->image;
    }
}
