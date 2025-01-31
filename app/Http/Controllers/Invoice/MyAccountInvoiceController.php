<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;

class MyAccountInvoiceController extends Controller
{
    public function orderInvoice(Order $order)
    {
        return view('ecommerce.my-account.invoice.order-invoice', compact('order'));
    }
}
