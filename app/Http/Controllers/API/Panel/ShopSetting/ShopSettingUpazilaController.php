<?php

namespace App\Http\Controllers\API\Panel\ShopSetting;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingUpazilaCreateRequest;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingUpazilaUpdateRequest;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingUpazilaDatatableResource;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingUpazilaListResource;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingUpazilaUpdateResource;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingStatusUpdateRequest;
use App\Models\Address\District;
use App\Models\Address\Upazila;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopSettingUpazilaController extends Controller
{
    use BaseModel;

    public function select_district(Request $request): JsonResponse
    {
        try {
            // Get the lists
            $lists = Upazila::getLists(Upazila::query(), $request->all(), ShopSettingUpazilaListResource::class);

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
        try {
            return $this->dataTable(Upazila::query(), $request->all(), ShopSettingUpazilaDatatableResource::class);
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
     * Upazila Info
     *
     * @param Upazila $upazila
     * @return JsonResponse
     */
    public function show(Upazila $upazila): JsonResponse
    {
        try {
            // Return success response with the upazila info
            return Message::success(null, new ShopSettingUpazilaUpdateResource($upazila));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store Upazila
     *
     * @param ShopSettingUpazilaCreateRequest $shopSettingUpazilaCreateRequest
     * @return JsonResponse
     */
    public function store(ShopSettingUpazilaCreateRequest $shopSettingUpazilaCreateRequest): JsonResponse
    {
        try {
            // Upazila save
            Upazila::create($shopSettingUpazilaCreateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update Upazila
     *
     * @param ShopSettingUpazilaUpdateRequest $shopSettingUpazilaUpdateRequest
     * @param Upazila $upazila
     * @return JsonResponse
     */
    public function update(ShopSettingUpazilaUpdateRequest $shopSettingUpazilaUpdateRequest, Upazila $upazila): JsonResponse
    {
        try {
            // Update upazila
            $upazila->update($shopSettingUpazilaUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update Upazila Location
     *
     * @param ShopSettingStatusUpdateRequest $shopSettingStatusUpdateRequest
     * @param Upazila $upazila
     * @return JsonResponse
     */
    public function statusUpdate(ShopSettingStatusUpdateRequest $shopSettingStatusUpdateRequest, Upazila $upazila): JsonResponse
    {
        try {
            // Update upazila location
            $upazila->update($shopSettingStatusUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Upazila Delete
     *
     * @param Upazila $upazila
     * @return JsonResponse
     */
    public function destroy(Upazila $upazila): JsonResponse
    {
        try {
            // Call the function delete upazila
            $upazila->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
