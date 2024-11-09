<?php

namespace App\Services;

class AddressService
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Store or update address data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeOrUpdate(Request $request)
    {
        // Call the AddressService to save data
        $address = $this->addressService->save($request->all(), $request->input('address_id'));

        return response()->json([
            'message' => 'Address saved successfully.',
            'address' => $address,
        ]);
    }
}
