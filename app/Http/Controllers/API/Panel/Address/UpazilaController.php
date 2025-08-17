<?php

namespace App\Http\Controllers\API\Panel\Address;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingUpazilaListResource;
use App\Models\Address\Upazila;
use App\Models\ShippingZoneLocation;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    /**
     * Division lists
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function lists(Request $request): JsonResponse|bool|string
    {
        try {
            $request['limit'] = 1000;
            $list = Upazila::selectLists(Upazila::where('district_id', $request->district_id), $request->all(), ShopSettingUpazilaListResource::class);

            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Get upazilas by shipping zone and district
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function shippingZoneWiseUpazilas(Request $request): JsonResponse|bool|string
    {
        try {
            // Get all upazilas for the district
            $upazilasQuery = Upazila::where('district_id', $request->district_id);

            // Pass shipping_zone_id so we can mark existing ones
            $shippingZoneId = $request->shipping_zone_id;

            $list = ShopSettingUpazilaListResource::collection(
                $upazilasQuery->get()->map(function ($upazila) use ($shippingZoneId) {
                    // Check if this upazila already exists for this shipping zone
                    $upazila->is_selected = ShippingZoneLocation::where('shipping_zone_id', $shippingZoneId)
                        ->where('upazila_id', $upazila->id)
                        ->exists();
                    return $upazila;
                })
            );
            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
}
