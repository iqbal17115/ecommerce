<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipping\ShippingChargeRequest;
use App\Models\Backend\Shipping\ShippingCharge;
use App\Services\ShippingChargeService;
use Exception;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    private $shippingChargeService;

    public function __construct(ShippingChargeService $shippingChargeService)
    {
        $this->shippingChargeService = $shippingChargeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $shippingClasses  = $this->shippingChargeService->getAllShippingClasses();
            $shippingMethods = $this->shippingChargeService->getAllShippingMethods();
            $shippingCharges = $this->shippingChargeService->getAllShippingCharges();
            return view('backend.shipping.index', compact('shippingClasses', 'shippingMethods', 'shippingCharges'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching shipping charge: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingChargeRequest $request)
    {
        $request->validated()['free_shipping'] = $request->validated()['free_shipping'] == 'on' ? 1 : 0;
        $shippingCharge = $this->shippingChargeService->createShippingCharge($request->validated());

        return response()->json([
            'success' => 'Shipping charge created successfully.',
            'shippingCharge' => $shippingCharge,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(ShippingCharge $shippingCharge)
    {
        return $shippingCharge;
    }

    public function update(Request $request, $id)
    {
        $shippingCharge = $this->shippingChargeService->updateShippingCharge($request->all(), $id);

        return response()->json([
            'success' => 'Shipping charge updated successfully.',
            'shippingCharge' => $shippingCharge,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
