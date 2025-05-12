<?php

namespace App\Http\Controllers\API\Panel\Address;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingUpazilaListResource;
use App\Models\Address\Upazila;
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
}
