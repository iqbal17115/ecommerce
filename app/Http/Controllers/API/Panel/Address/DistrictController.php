<?php

namespace App\Http\Controllers\API\Panel\Address;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\Panel\API\Address\District\DistrictListResource;
use App\Models\Address\District;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    use BaseModel;

    /**
     * Division lists
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function lists(Request $request): JsonResponse|bool|string
    {
        try {
            $list = District::getLists(District::where('division_id', $request->division_id), $request->all(), DistrictListResource::class);

            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
}
