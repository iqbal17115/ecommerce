<?php

namespace App\Http\Controllers\API\Panel\Address;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\Panel\API\Address\Country\CountryListResource;
use App\Models\Address\Country;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Country lists
     *
     * @param Request $request
     * @return bool|JsonResponse|string
     */
    public function lists(Request $request): JsonResponse|bool|string
    {
        try {
            $list = Country::selectLists(Country::query(), $request->all(), CountryListResource::class);

            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
}
