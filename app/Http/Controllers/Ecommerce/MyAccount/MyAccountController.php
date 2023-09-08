<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    // In your controller
    public function getUserOrders(Request $request)
    {
        $user = User::with('Contact.Order.orderProductBox', 'Contact.Order.OrderDetail.Product')->find($request->user_id);
        $orders = $user->Contact->Order;

        if ($request->code) {
            $orders = $orders->filter(function ($order) use ($request) {
                return str_contains($order->code, $request->code);
            });
        }
        $fromDate = \Carbon\Carbon::parse($request->from_date)->startOfDay();
        $toDate = \Carbon\Carbon::parse($request->to_date)->endOfDay();


        if ($fromDate && $toDate) {
            $orders = $orders->whereBetween('order_date', [$fromDate, $toDate]);
        } elseif ($fromDate) {
            $orders = $orders->where('order_date', '>=', $fromDate);
        } elseif ($toDate) {
            $orders = $orders->where('order_date', '<=', $toDate);
        }

        if ($request->items_per_page_select) {
            $orders = $orders->take($request->items_per_page_select);
        }

        return response()->json(['orders' => $orders]);
    }
    public function index()
    {
        $user = Auth::user();
        return view('ecommerce.my-account.my-account', compact('user'));
    }
}
