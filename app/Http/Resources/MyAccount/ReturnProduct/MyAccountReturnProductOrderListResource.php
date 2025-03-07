<?php

namespace App\Http\Resources\MyAccount\ReturnProduct;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyAccountReturnProductOrderListResource extends JsonResource
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
            'delivered_at' => Carbon::parse($this->created_at)->format('d M Y'), // Assuming you have a 'delivered_at' column
            'total_amount' => $this->payable_amount,
            'order_items' => MyAccountReturnProductOrderDetailResource::collection($this->OrderDetail),
        ];
    }
}
