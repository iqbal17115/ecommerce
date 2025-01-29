<?php

namespace App\Http\Resources\User\OrderDetail;

use App\Enums\OrderTrackingStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "total_amount" => $this->total_amount,
            "other_amount" => $this->other_amount,
            "discount" => $this->discount,
            "shipping_charge" => $this->shipping_charge,
            "vat" => $this->vat,
            "payable_amount" => $this->payable_amount,
            "note" => $this->note,
            "status" => $this->status,
            "order_details" => OrderDetailResource::collection($this->OrderDetail),
            "order_statuses" => ["pending", "processing", "shipped", "delivered"],
            "order_tracking" => OrderTrackingResource::collection($this->orderTracking),
            "status_messages" => [
                'pending' => 'Thank you for shopping at Aladdinne.com ! Your order Is being verified. ',
                'processing' => 'Your order is now being processed and prepared for shipment.',
                'shipped' => 'Your Package has been packed and its being handed over to logistic partner',
                'out_for_delivery' => 'Your order is out for delivery and will be at your doorstep soon. Please ensure someone is available to receive it.',
                'delivered' => 'Your order has been successfully delivered., Thank you for Shopping at Aladdinne.com!',
            ]
        ];
    }
}
