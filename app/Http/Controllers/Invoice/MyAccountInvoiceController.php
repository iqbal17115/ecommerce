<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Backend\WebSetting\CompanyInfo;
use App\Models\FrontEnd\Order;

class MyAccountInvoiceController extends Controller
{
    public function orderInvoice(Order $order)
    {
        $company_info = CompanyInfo::first();

        return view('ecommerce.my-account.invoice.order-invoice', compact('order', 'company_info'));
    }
}
