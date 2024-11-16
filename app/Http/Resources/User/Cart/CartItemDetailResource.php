<?php

namespace App\Http\Resources\User\Cart;

use App\Http\Resources\CurrencyResource;
use App\Models\Backend\Currency\Currency;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemDetailResource extends JsonResource
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
            "product_info" => new CartProductDetailResource($this->product),
            "quantity" => (int)$this->quantity,
            "active_currency" => new CurrencyResource($activeCurrency),
        ];
    }
}
