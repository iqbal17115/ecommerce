<?php

namespace App\Http\Controllers\Backend\OrderProduct;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;

class OrderProductReturnController extends Controller
{
    public function index(Order $order)
    {
        return view('backend.order-product.return-product', compact('order'));
    }
}
