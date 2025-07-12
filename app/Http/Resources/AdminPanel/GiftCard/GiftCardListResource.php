<?php

namespace App\Http\Resources\AdminPanel\GiftCard;

use Illuminate\Http\Resources\Json\JsonResource;

class GiftCardListResource extends JsonResource
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
            'amount' => $this->amount,
            'balance' => $this->balance,
            'recipient_email' => $this->recipient_email,
            'sender_name' => $this->sender_name,
            'expiration_date' => $this->expiration_date,
            'status' => $this->status
        ];
    }
}
