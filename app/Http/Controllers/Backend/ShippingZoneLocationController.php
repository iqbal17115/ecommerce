<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\ShippingZoneLocation\ShippingZoneLocationStoreRequest;
use App\Http\Requests\ListRequest;
use App\Http\Resources\AdminPanel\ShippingZoneLocation\ShippingZoneLocationListResource;
use App\Models\ShippingZoneLocation;
use App\Services\ShippingZoneLocationService;
use App\Traits\BaseModel;

class ShippingZoneLocationController extends Controller
{
    use BaseModel;

    protected $service;

    public function __construct(ShippingZoneLocationService $service)
    {
        $this->service = $service;
    }

    public function index(ListRequest $request)
    {
        return $this->dataTable(ShippingZoneLocation::query(), $request->all(), ShippingZoneLocationListResource::class);
    }

    // Store multiple locations
    public function store(ShippingZoneLocationStoreRequest $request)
    {
        $validated = $request->validated();

        $this->service->storeLocations($validated);

        return response()->json(['message' => 'Locations added successfully']);
    }

    // Optionally, destroy a single location
    public function destroy($id)
    {
        $this->service->deleteLocation($id);

        return response()->json(['message' => 'Location deleted successfully']);
    }
}
