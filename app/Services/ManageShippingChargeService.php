<?php

namespace App\Services;

use App\Models\ShippingCharge;

class ManageShippingChargeService
{
    public function listAll()
    {
        return ShippingCharge::with(['division', 'district', 'upazila'])->latest()->get();
    }

    public function getById(string $id): ShippingCharge
    {
        return ShippingCharge::with(['division', 'district', 'upazila'])->findOrFail($id);
    }

    public function create(array $data): ShippingCharge
    {
        return ShippingCharge::create($data);
    }

    public function update(string $id, array $data): ShippingCharge
    {
        $shippingCharge = $this->getById($id);
        $shippingCharge->update($data);
        return $shippingCharge;
    }

    public function delete(string $id): void
    {
        $shippingCharge = $this->getById($id);
        $shippingCharge->delete();
    }
}
