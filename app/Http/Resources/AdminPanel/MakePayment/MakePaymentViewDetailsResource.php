<?php

namespace App\Http\Resources\AdminPanel\MakePayment;

use App\Helpers\TextFormatHelper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MakePaymentViewDetailsResource extends JsonResource
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
            'payment_date' => Carbon::parse($this->date)->format('d-m-Y'),
            'payment_method' => TextFormatHelper::formatText($this->payment_method),
            'amount' => $this->amount,
            'note' => $this->note,
        ];
    }
}
