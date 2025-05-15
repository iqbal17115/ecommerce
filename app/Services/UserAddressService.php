<?php

namespace App\Services;

use App\Models\UserAddress;
use Illuminate\Support\Facades\DB;

class UserAddressService
{
    public function storeOrUpdate(array $data, $addressId = null)
    {
        return DB::transaction(function () use ($data, $addressId) {
            $userId = auth()->id();

            if ($addressId) {
                $address = UserAddress::where('id', $addressId)
                    ->where('user_id', $userId)
                    ->firstOrFail();
                $address->update($data);
            } else {
                $address = UserAddress::create(array_merge($data, ['user_id' => $userId]));
            }

            // If request says this is default, make it so and unset all others
            if (!empty($data['is_default'])) {
                UserAddress::where('user_id', $userId)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            } else {
                // If no is_default sent and no other address is default, make this one default
                $hasDefault = UserAddress::where('user_id', $userId)
                    ->where('is_default', true)
                    ->exists();

                if (!$hasDefault) {
                    $address->update(['is_default' => true]);
                }
            }

            return $address;
        });
    }
}
