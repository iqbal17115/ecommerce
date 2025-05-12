<?php

namespace App\Http\Resources\User\UserAddress;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressListResource extends JsonResource
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
            'name' => $this->user->name,
            'mobile' => $this->mobile,
            'optional_mobile' => $this->optional_mobile,
            'address' => $this->formatAddress(),
            'type' => $this->type,
            'is_default' => $this->is_default,
            'country' => $this->country?->name,
            'division' => $this->division?->name,
            'district' => $this->district?->name,
            'upazila' => $this->upazila?->name,
        ];
    }

    protected function formatAddress()
    {
        $parts = array_filter([
            $this->street_address,
            $this->building_name,
            $this->nearest_landmark,
            optional($this->area)->name,
            optional($this->district)->name,
            optional($this->division)->name,
            optional($this->country)->name,
        ]);

        return implode(', ', $parts);
    }
}
