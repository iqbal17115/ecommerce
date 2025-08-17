<?php

namespace App\Services;

use App\Models\ShippingZone;

class ShippingZoneService
{
    public function getAllZones()
    {
        return ShippingZone::orderBy('name')->get();
    }

    public function storeZone($data)
    {
        return ShippingZone::create($data);
    }

    public function updateZone($id, $data)
    {
        $zone = ShippingZone::findOrFail($id);
        $zone->update($data);
        return $zone;
    }

    public function deleteZone($id)
    {
        $zone = ShippingZone::findOrFail($id);
        $zone->delete();
        return true;
    }

    public function getZone($id)
    {
        return ShippingZone::findOrFail($id);
    }
}
