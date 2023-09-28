<?php

namespace App\Http\Controllers\API\Panel\ShopSetting;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingDivisionCreateRequest;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingDivisionUpdateRequest;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingDivisionDatatableResource;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingDivisionUpdateResource;
use App\Models\Address\Division;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopSettingDivisionController extends Controller
{
    use BaseModel;

    /**
     * Lists
     *
     * @param Request $request
     * @return string|bool
     */
    public function lists(Request $request): bool|string
    {
        try {
            return $this->dataTable(Division::query(), $request->all(), ShopSettingDivisionDatatableResource::class);
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
            $lists = Division::getLists(Division::query(), $request->all(), SelectListResource::class);

            // Return success response with the lists
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Division Info
     *
     * @param Division $division
     * @return JsonResponse
     */
    public function show(Division $division): JsonResponse
    {
        try {
            // Return success response with the division info
            return Message::success(null, new ShopSettingDivisionUpdateResource($division));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store Division
     *
     * @param ShopSettingDivisionCreateRequest $shopSettingDivisionCreateRequest
     * @return JsonResponse
     */
    public function store(ShopSettingDivisionCreateRequest $shopSettingDivisionCreateRequest): JsonResponse
    {
        try {
            // Division save
            Division::create($shopSettingDivisionCreateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update Division
     *
     * @param ShopSettingDivisionUpdateRequest $shopSettingDivisionUpdateRequest
     * @param Division $division
     * @return JsonResponse
     */
    public function update(ShopSettingDivisionUpdateRequest $shopSettingDivisionUpdateRequest, Division $division): JsonResponse
    {
        try {
            // Update division
            $division->update($shopSettingDivisionUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Division Delete
     *
     * @param Division $division
     * @return JsonResponse
     */
    public function destroy(Division $division): JsonResponse
    {
        try {
            // Call the function delete division
            $division->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
