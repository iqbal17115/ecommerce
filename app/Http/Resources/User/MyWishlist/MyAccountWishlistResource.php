<?php

namespace App\Http\Resources\User\MyWishlist;

use Illuminate\Http\Resources\Json\JsonResource;

class MyAccountWishlistResource extends JsonResource
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
            'product' =>  MyAccountWishlistProductResource::make($this->product),
            'item_added_at' => $this->created_at->diffForHumans(),
        ];
    }
}
