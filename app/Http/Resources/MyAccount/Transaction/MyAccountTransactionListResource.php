<?php

namespace App\Http\Resources\MyAccount\Transaction;

use App\Helpers\TextFormatHelper;
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
            'date' => Carbon::parse($this->date)->format('d-m-Y'),
            'order_code' => $this->orderPayment->order->code,
            'payment_type' => TextFormatHelper::formatText($this->payment_type),
            'payment_method' => TextFormatHelper::formatText($this->payment_method),
            'amount' => $this->amount
        ];
    }
}
