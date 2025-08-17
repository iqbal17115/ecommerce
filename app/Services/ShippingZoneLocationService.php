<?php

namespace App\Services;

use App\Models\ShippingZoneLocation;

class ShippingZoneLocationService
{
    // Store multiple locations in batch
    public function storeLocations($data)
    {
        $shippingZoneId = $data['shipping_zone_id'];
        $locations = $data['locations'];

        foreach ($locations as $location) {
            $divisionId = $location['division_id'];
            $districtId = $location['district_id'];
            $upazilaIds = $location['upazila_ids'];

            // Get existing upazilas for this shipping_zone + division + district
            $existingUpazilas = ShippingZoneLocation::where('shipping_zone_id', $shippingZoneId)
                ->where('division_id', $divisionId)
                ->where('district_id', $districtId)
                ->pluck('upazila_id')
                ->toArray();

            // Delete upazilas that are not in the new submission
            $toDelete = array_diff($existingUpazilas, $upazilaIds);
            if (!empty($toDelete)) {
                ShippingZoneLocation::where('shipping_zone_id', $shippingZoneId)
                    ->where('division_id', $divisionId)
                    ->where('district_id', $districtId)
                    ->whereIn('upazila_id', $toDelete)
                    ->delete();
            }

            // Insert new upazilas that are not already in DB
            $toInsert = array_diff($upazilaIds, $existingUpazilas);
            foreach ($toInsert as $upazilaId) {
                ShippingZoneLocation::create([
                    'shipping_zone_id' => $shippingZoneId,
                    'division_id' => $divisionId,
                    'district_id' => $districtId,
                    'upazila_id' => $upazilaId,
                ]);
            }
        }
    }

    // Delete single location
    public function deleteLocation($id)
    {
        $location = ShippingZoneLocation::findOrFail($id);
        $location->delete();
    }
}
