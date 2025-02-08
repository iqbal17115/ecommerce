<?php

namespace App\Http\Resources;

use App\Enums\PaymentStatusEnum;
use App\Helpers\TextFormatHelper;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Resources\Json\JsonResource;
use PHPUnit\Framework\Test;

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
            'id' => $this->id,
            'code' => $this->code,
            'order_date' => $this->order_date,
            'total_amount' => $this->total_amount,
            'other_amount' => $this->other_amount,
            'discount' => $this->discount,
            'shipping_charge' => $this->shipping_charge,
            'vat' => $this->vat,
            'payable_amount' => $this->payable_amount,
            'note' => $this->note,
            'payment_status' => TextFormatHelper::formatText($this?->orderPayment?->payment_status ?? PaymentStatusEnum::PENDING),
            'status' => $this->status,
            'order_details' => OrderDetailResource::collection($this->OrderDetail),
            'contact' => new ContactResource($this->Contact)
        ];
    }
}
