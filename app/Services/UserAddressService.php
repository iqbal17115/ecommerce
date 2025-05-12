<?php

namespace App\Services;

use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class UserAddressService
{
    public function storeOrUpdate(array $data, $addressId = null)
    {
        return DB::transaction(function () use ($data, $addressId) {
            if ($addressId) {
                $address = UserAddress::where('id', $addressId)->where('user_id', auth()->id())->firstOrFail();
                $address->update($data);
            } else {
                $address = UserAddress::create(array_merge($data, ['user_id' => auth()->id()]));
            }

            // Handle default flag: if is_default is true, unset others
            if (!empty($data['is_default'])) {
                UserAddress::where('user_id', auth()->id())
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }

            return $address;
        });
    }
}
