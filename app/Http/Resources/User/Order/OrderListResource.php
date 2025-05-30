<?php

namespace App\Http\Resources\User\Order;

use App\Helpers\TextFormatHelper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderListResource extends JsonResource
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
            "code" => $this->code,
            "order_date" => $this->order_date,
            "estimate_delivery_date" => Carbon::parse($this->estimate_delivery_date)->format('d F Y'),
            "total_amount" => $this->total_amount,
            "other_amount" => $this->other_amount,
            "discount" => $this->discount,
            "shipping_charge" => $this->shipping_charge,
            "vat" => $this->vat,
            "payable_amount" => $this->payable_amount,
            "note" => $this->note,
            "status" => $this->status,
            "payment_status" => TextFormatHelper::formatText($this->orderPayment->payment_status),
            "order_address" => new OrderAddressResource($this->orderAddress),
            "order_details" => OrderDetailsResource::collection($this->OrderDetail),
        ];
    }
}
