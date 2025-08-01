<?php

namespace App\Http\Controllers\API\Panel\ShopSetting;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingDistrictCreateRequest;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingDistrictUpdateRequest;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingLocationUpdateRequest;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingStatusUpdateRequest;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingDistrictDatatableResource;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingDistrictListResource;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingDistrictUpdateResource;
use App\Models\Address\District;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopSettingDistrictController extends Controller
{
    use BaseModel;


    public function select_district(Request $request): JsonResponse
    {
        try {
            // Get the lists
            $lists = District::getLists(District::query(), $request->all(), ShopSettingDistrictListResource::class);

            // Return success response with the lists
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
    /**
     * Lists
     *
     * @param Request $request
     * @return string|bool
     */
    public function lists(Request $request): bool|string
    {
        dd(111);
        try {
            return $this->dataTable(District::query(), $request->all(), ShopSettingDistrictDatatableResource::class);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Select Lists
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function selectLists(Request $request): JsonResponse
    {
        try {
            // Get the lists
            $lists = District::getLists(District::query(), $request->all(), SelectListResource::class);

            // Return success response with the lists
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * District Info
     *
     * @param District $district
     * @return JsonResponse
     */
    public function show(District $district): JsonResponse
    {
        try {
            // Return success response with the district info
            return Message::success(null, new ShopSettingDistrictUpdateResource($district));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store District
     *
     * @param ShopSettingDistrictCreateRequest $shopSettingDistrictCreateRequest
     * @return JsonResponse
     */
    public function store(ShopSettingDistrictCreateRequest $shopSettingDistrictCreateRequest): JsonResponse
    {
        try {
            // District save
            District::create($shopSettingDistrictCreateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update District Location
     *
     * @param ShopSettingLocationUpdateRequest $shopSettingLocationUpdateRequest
     * @param District $district
     * @return JsonResponse
     */
    public function locationUpdate(ShopSettingLocationUpdateRequest $shopSettingLocationUpdateRequest, District $district): JsonResponse
    {
        try {
            // Update district location
            $district->update($shopSettingLocationUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

     /**
     * Update District Location
     *
     * @param ShopSettingStatusUpdateRequest $shopSettingStatusUpdateRequest
     * @param District $district
     * @return JsonResponse
     */
    public function statusUpdate(ShopSettingStatusUpdateRequest $shopSettingStatusUpdateRequest, District $district): JsonResponse
    {
        try {
            // Update district location
            $district->update($shopSettingStatusUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update District
     *
     * @param ShopSettingDistrictUpdateRequest $shopSettingDistrictUpdateRequest
     * @param District $district
     * @return JsonResponse
     */
    public function update(ShopSettingDistrictUpdateRequest $shopSettingDistrictUpdateRequest, District $district): JsonResponse
    {
        try {
            // Update district
            $district->update($shopSettingDistrictUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * District Delete
     *
     * @param District $district
     * @return JsonResponse
     */
    public function destroy(District $district): JsonResponse
    {
        try {
            // Call the function delete district
            $district->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
