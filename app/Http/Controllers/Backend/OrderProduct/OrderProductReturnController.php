<?php

namespace App\Http\Controllers\Backend\OrderProduct;

use App\Enums\ProductReturnReasonEnum;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;

class OrderProductReturnController extends Controller
{
    public function index(Order $order)
    {
        $return_reasons = ProductReturnReasonEnum::getReasons();
        return view('backend.order-product.return-product', compact('order', 'return_reasons'));
    }
}
