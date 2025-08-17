<?php

namespace App\Services;

use App\Models\ShippingZone;
use App\Models\ShippingRate;
use App\Models\ShippingInsideOutside;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ShippingPricingService
{
    public function ensureZoneType(string $zoneId, array $allowedTypes): ShippingZone
    {
        /** @var ShippingZone $zone */
        $zone = ShippingZone::query()->where('id', $zoneId)->first();

        if (!$zone) {
            throw new ModelNotFoundException('Shipping zone not found.');
        }

        if (!in_array($zone->type, $allowedTypes, true)) {
            throw new Exception("This operation is not allowed for zone type '{$zone->type}'.");
        }

        return $zone;
    }

    /* ---------- RATES (location/amount/weight/qty based) ---------- */

    public function listRates(?string $zoneId = null): Collection
    {
        return ShippingRate::query()
            ->when($zoneId, fn($q) => $q->where('shipping_zone_id', $zoneId))
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function createRate(array $data): ShippingRate
    {
        $this->ensureZoneType($data['shipping_zone_id'], ['location', 'mixed']); // inside_outside নয়
        return ShippingRate::create([
            'id'               => (string) \Str::uuid(),
            'shipping_zone_id' => $data['shipping_zone_id'],
            'min_weight'       => $data['min_weight'] ?? null,
            'max_weight'       => $data['max_weight'] ?? null,
            'min_amount'       => $data['min_amount'] ?? null,
            'max_amount'       => $data['max_amount'] ?? null,
            'min_qty'          => $data['min_qty'] ?? null,
            'max_qty'          => $data['max_qty'] ?? null,
            'rate'             => $data['rate'],
            'is_active'        => $data['is_active'] ?? true,
            'priority'         => $data['priority'] ?? 0,
        ]);
    }

    public function updateRate(string $id, array $data): ShippingRate
    {
        /** @var ShippingRate $rate */
        $rate = ShippingRate::findOrFail($id);

        $this->ensureZoneType($rate->shipping_zone_id, ['location', 'mixed']);

        $rate->fill($data);
        $rate->save();

        return $rate;
    }

    public function deleteRate(string $id): void
    {
        $rate = ShippingRate::findOrFail($id);
        $this->ensureZoneType($rate->shipping_zone_id, ['location', 'mixed']);
        $rate->delete();
    }

    /* ---------- INSIDE/OUTSIDE ---------- */

    public function showInsideOutside(string $zoneId): ?ShippingInsideOutside
    {
        return ShippingInsideOutside::query()->where('shipping_zone_id', $zoneId)->first();
    }

    public function upsertInsideOutside(array $data): ShippingInsideOutside
    {
        $zone = $this->ensureZoneType($data['shipping_zone_id'], ['inside_outside']);

        /** @var ShippingInsideOutside $row */
        $row = ShippingInsideOutside::query()
            ->firstOrNew(['shipping_zone_id' => $zone->id]);

        $row->fill([
            'inside_rate'  => $data['inside_rate'],
            'outside_rate' => $data['outside_rate'],
        ]);

        if (!$row->exists) {
            $row->id = (string) Str::uuid();
        }

        $row->save();

        return $row;
    }
}
