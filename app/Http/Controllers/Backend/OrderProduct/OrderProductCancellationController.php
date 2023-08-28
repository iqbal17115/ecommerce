<?php

namespace App\Http\Controllers\Backend\OrderProduct;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;

class OrderProductCancellationController extends Controller
{
    public function index(Order $order)
    {
        return view('backend.order-product.cancellation-product', compact('order'));
    }
}