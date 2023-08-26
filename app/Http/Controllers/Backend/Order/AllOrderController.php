<?php

namespace App\Http\Controllers\Backend\Order;

use App\Enums\LengthUnitEnum;
use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;

class AllOrderController extends Controller
{
    public function advanceEdit(Order $order) {
        $lengthUnits = LengthUnitEnum::getOptions();

        return view('backend.order.advance-edit', compact('order', 'lengthUnits'));
    }

    public function index()
    {
        $reflectionClass = new \ReflectionClass(OrderStatusEnum::class);
        $statusValues = array_values($reflectionClass->getConstants());
        return view('backend.order.all-order', compact('statusValues'));
    }
}
