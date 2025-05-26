<?php

namespace App\Http\Resources\User\Checkout\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class ActiveCartItemProductVariationResource extends JsonResource
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
            "attribute_name" => $this->attributeValue?->attribute?->name,
            "attribute_value" => $this->attributeValue?->value
        ];
    }
}
