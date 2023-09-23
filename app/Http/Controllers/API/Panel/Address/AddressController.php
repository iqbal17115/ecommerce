<?php

namespace App\Http\Controllers\API\Panel\Address;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\MyAccount\Address\AddressCreateRequest;
use App\Http\Requests\Order\MyAccount\Address\AddressUpdateRequest;
use App\Http\Resources\Panel\API\Address\AddressListResource;
use App\Http\Resources\Panel\API\Address\AddressUpdateResource;
use App\Models\Address\Address;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    use BaseModel;

    /**
     * Store Address
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function setAsDefault(Request $request): JsonResponse
    {
        try {
            Address::where('user_id', $request->user_id)->update(['is_default' => 0]);
            // Address save
            $address = Address::find($request->address_id);
            $address->is_default = 1;
            $address->save();
            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Update Address
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function update(AddressUpdateRequest $addressUpdateRequest, Address $address): JsonResponse
    {
        try {
            $address->update($addressUpdateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Address Info
     *
     * @param Address $institute
     * @return JsonResponse
     */
    public function show(Address $address): JsonResponse
    {
        try {
            // Return success response with the address info
            return Message::success(null, new AddressUpdateResource($address));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * My Address Lists
     *
     * @param Request $request
     * @return string|bool
     */
    public function myAddressList(Request $request): JsonResponse
    {
        try {
            $list = $this->getLists(Address::where('user_id', $request->user_id)->orderByDesc('is_default'), $request->all(), AddressListResource::class);
            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store Address
     *
     * @param AddressCreateRequest $addressCreateRequest
     * @return JsonResponse
     */
    public function store(AddressCreateRequest $addressCreateRequest): JsonResponse
    {
        try {
            // Address save
            Address::create($addressCreateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
