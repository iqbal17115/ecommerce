<?php

namespace App\Http\Controllers\API\Panel\ShopSetting;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\ShopSetting\CountryCreateRequest;
use App\Http\Requests\AdminPanel\ShopSetting\CountryUpdateRequest;
use App\Http\Requests\AdminPanel\ShopSetting\ShopSettingCountryStatusUpdateRequest;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingCountryListResource;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingCountryUpdateResource;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingDatatableResource;
use App\Models\Address\Country;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopSettingCountryController extends Controller
{
    use BaseModel;

    public function select_country(Request $request): JsonResponse
    {
        try {
            // Get the lists
            $lists = Country::getLists(Country::query(), $request->all(), ShopSettingCountryListResource::class);

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
            return $this->dataTable(Country::query(), $request->all(), ShopSettingDatatableResource::class);
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
            $lists = Country::getLists(Country::query(), $request->all(), SelectListResource::class);

            // Return success response with the lists
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Country Info
     *
     * @param Country $country
     * @return JsonResponse
     */
    public function show(Country $country): JsonResponse
    {
        try {
            // Return success response with the country info
            return Message::success(null, new ShopSettingCountryUpdateResource($country));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store Country
     *
     * @param CountryCreateRequest $countryCreateRequest
     * @return JsonResponse
     */
    public function store(CountryCreateRequest $countryCreateRequest): JsonResponse
    {
        try {
            // Country save
            Country::create($countryCreateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update Country
     *
     * @param CountryUpdateRequest $countryUpdateRequest
     * @param Country $country
     * @return JsonResponse
     */
    public function update(CountryUpdateRequest $countryUpdateRequest, Country $country): JsonResponse
    {
        try {
            // Update country
            $country->update($countryUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update Country Location
     *
     * @param ShopSettingCountryStatusUpdateRequest $shopSettingCountryStatusUpdateRequest
     * @param Country $country
     * @return JsonResponse
     */
    public function statusUpdate(ShopSettingCountryStatusUpdateRequest $shopSettingCountryStatusUpdateRequest, Country $country): JsonResponse
    {
        try {
            // Update country location
            $country->update($shopSettingCountryStatusUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Country Delete
     *
     * @param Country $country
     * @return JsonResponse
     */
    public function destroy(Country $country): JsonResponse
    {
        try {
            // Call the function delete country
            $country->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
