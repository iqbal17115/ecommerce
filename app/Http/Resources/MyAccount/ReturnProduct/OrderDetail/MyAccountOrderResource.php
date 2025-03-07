<?php

namespace App\Http\Resources\MyAccount\ReturnProduct\OrderDetail;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyAccountOrderResource extends JsonResource
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
            'order_number' => $this->code,
            'ordered_at' => Carbon::parse($this->order_date)->format('d M Y'),
            'delivered_at' => $this->created_at ? Carbon::parse($this->created_at)->format('d M Y') : null,
            'total_amount' => $this->payable_amount,
            'order_items' => MyAccountOrderDetailResource::collection($this->OrderDetail),
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'note' => $this->note,
            'discount' => $this->discount,
            'shipping_charge' => $this->shipping_charge,
        ];
    }
}
