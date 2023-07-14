<?php

namespace App\Http\Controllers\Backend\Shipping;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'shipping_class_id' => 'required|exists:shipping_classes,id',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'charge' => 'required|numeric',
            'min_quantity' => 'nullable|integer',
            'max_quantity' => 'nullable|integer',
            'area' => 'nullable|integer',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'free_shipping' => 'nullable',
            'minimum_amount_for_free_shipping' => 'nullable|numeric',
            'maximum_amount_for_free_shipping' => 'nullable|numeric',
        ]);

        $shippingCharge = $this->shippingChargeService->createShippingCharge($request->all());

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
