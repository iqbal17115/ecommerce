<?php

namespace App\Http\Resources\MyAccount\ReturnProduct;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyAccountReturnProductOrderDetailResource extends JsonResource
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
            'vendor_id' => $this->vendor_id,
            'product' => [
                'id' => $this->Product->id,
                'name' => $this->Product->name,
                'image' => $this->getFirstProductImage() ? asset('storage/product_photo/'.$this->getFirstProductImage()) : '', 
            ],
            'unit_price' => $this->unit_price,
            'quantity' => $this->quantity,
            'subtotal' => $this->unit_price * $this->quantity,
            'return_eligible_date' => Carbon::parse($this->order->created_at)->addDays(1)->format('d M Y'), 
        ];
    }

    protected function getFirstProductImage()
    {
        return $this->ProductImage?->first()?->image;
    }
}
