<?php

namespace App\Http\Resources\MyAccount\Transaction;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyAccountTransactionListResource extends JsonResource
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
            'order_code' => $this->order?->code,
            'total_order_price' => $this->total_order_price,
            'total_discount_amount' => $this->total_discount_amount,
            'total_shipping_charge_amount' => $this->total_shipping_charge_amount,
            'total_amount' => $this->total_amount,
            'amount_paid' => $this->amount_paid,
            'due_amount' => $this->due_amount
        ];
    }
}
