<?php

namespace App\Http\Controllers\API\Panel\Address;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\MyAccount\Address\AddressCreateRequest;
use App\Http\Requests\Order\MyAccount\Address\AddressUpdateRequest;
use App\Http\Resources\AdminPanel\ShopSetting\ShopSettingAddressInstructionResource;
use App\Http\Resources\Panel\API\Address\AddressListResource;
use App\Http\Resources\Panel\API\Address\AddressUpdateResource;
use App\Http\Resources\User\Checkout\Address\AddressUpdateDetailResource;
use App\Models\Address\Address;
use App\Models\Address\AddressInstruction;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    use BaseModel;

    /**
     * Address Info
     *
     * @param Address $institute
     * @return JsonResponse
     */
    public function addressInstructionShow(Address $address): JsonResponse
    {
        try {
            $address_instruction = AddressInstruction::where('address_id', $address->id)->first();
            // Return success response with the address info
            return Message::success(null, new ShopSettingAddressInstructionResource($address_instruction));
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Address Delete
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy(Address $address): JsonResponse
    {
        try {
            // Call the function delete address
            $address->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    /**
     * Store Address
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function setAsDefault(Request $request): JsonResponse
    {
        try {
            $userId = $request->user_id;
            $addressId = $request->address_id;

            Address::where('user_id', $userId)->update(['is_default' => 0]);

            Address::where('user_id', $userId)->where('id', $addressId)->update(['is_default' => 1]);

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
    public function update(AddressUpdateRequest $addressUpdateRequest): JsonResponse
    {
        try {
            $address = Address::find($addressUpdateRequest['address_id']);
            
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
     * Address Info
     *
     * @param Address $institute
     * @return JsonResponse
     */
    public function details(Address $address): JsonResponse
    {
        try {
            // Return success response with the address info comment test
            return Message::success(null, new AddressUpdateDetailResource($address));
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
            $list = $this->getLists(Address::where('user_id', Auth::user()->id)->orderByDesc('is_default'), $request->all(), AddressListResource::class);
            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }


    public function storeInstruction(Request $request): JsonResponse
    {
        try {
            // Address save
            $formData = json_decode($request->getContent(), true);
            $address = Address::find($request->address_id);
            if ($address->addressInstruction) {
                // Update the existing instruction
                $address->addressInstruction->update([
                    'property_type' => $formData['propertyName'],
                    'closed_day_for_delivery' => json_encode($formData['deliveryDays']),
                    'package_leave_address' => $formData['package_leave_address'],
                    'description' => $formData['description']
                ]);
            } else {
                // Create a new instruction
                AddressInstruction::create([
                    'address_id' => $address->id,
                    'property_type' => $formData['propertyName'],
                    'closed_day_for_delivery' => json_encode($formData['deliveryDays']),
                    'package_leave_address' => $formData['package_leave_address'],
                    'description' => $formData['description']
                ]);
            }

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
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
            $validatedData = $addressCreateRequest->validated();

            if ((new Address())->userAddressesCount($validatedData['user_id']) == 0) {
                $validatedData['is_default'] = 1;
            }

            // Address save
            Address::create($validatedData);

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
