<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\ShippingZone\ShippingZoneStoreRequest;
use App\Http\Requests\ListRequest;
use App\Http\Requests\SelectListRequest;
use App\Http\Resources\AdminPanel\ShippingZone\ShippingZoneResource;
use App\Http\Resources\AdminPanel\ShippingZone\ShippingZoneShowResource;
use App\Http\Resources\SelectListResource;
use App\Models\ShippingZone;
use App\Services\ShippingZoneService;
use App\Traits\BaseModel;
use Yajra\DataTables\Html\Editor\Fields\Select;

class ShippingZoneController extends Controller
{
    use BaseModel;

    protected $service;

    public function __construct(ShippingZoneService $service)
    {
        $this->service = $service;
    }

    public function index(ListRequest $request)
    {
        return $this->dataTable(ShippingZone::query(), $request->all(), ShippingZoneResource::class);
    }

    public function selectLists(SelectListRequest $request)
    {
         // Get the lists
        $lists = ShippingZone::selectLists(ShippingZone::query(), $request->validated(), SelectListResource::class);

        // Return success response with the lists
        return Message::success(null, $lists);
    }

    public function show($id)
    {
        $zone = $this->service->getZone($id);
        return response()->json(['results' => new ShippingZoneShowResource($zone)]);
    }

    public function store(ShippingZoneStoreRequest $request)
    {
        $zone = $this->service->storeZone($request->validated());
        return response()->json([
            'message' => 'Shipping zone created successfully',
            'results' => new ShippingZoneResource($zone)
        ]);
    }

    public function update(ShippingZoneStoreRequest $request, $id)
    {
        $zone = $this->service->updateZone($id, $request->validated());
        return response()->json([
            'message' => 'Shipping zone updated successfully',
            'results' => new ShippingZoneResource($zone)
        ]);
    }

    public function updateStatus($id)
    {
        $zone = ShippingZone::findOrFail($id);
        $zone->is_active = ! $zone->is_active;
        $zone->save();
        return response()->json([
            'message' => 'Shipping zone status updated successfully',
            'results' => new ShippingZoneResource($zone)
        ]);
    }

    public function destroy($id)
    {
        $this->service->deleteZone($id);
        return response()->json(['message' => 'Shipping zone deleted successfully']);
    }
}
