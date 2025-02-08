<?php

namespace App\Http\Resources\AdminPanel\MakePayment;

use App\Helpers\TextFormatHelper;
use App\Http\Resources\AdminPanel\MakePayment\MakePaymentViewDetailsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MakePaymentViewResource extends JsonResource
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
            'order_id' => $this->order_id,
            'total_order_price' => $this->total_order_price,
            'total_discount_amount' => $this->total_discount_amount,
            'total_shipping_charge_amount' => $this->total_shipping_charge_amount,
            'total_amount' => $this->total_amount,
            'amount_paid' => $this->amount_paid,
            'due_amount' => $this->due_amount,
            'total_receive_amount' => $this->total_receive_amount,
            'payment_status' => TextFormatHelper::formatText($this->payment_status),
            'payment_details' => MakePaymentViewDetailsResource::collection($this->orderPaymentDetails),
        ];
    }
}
