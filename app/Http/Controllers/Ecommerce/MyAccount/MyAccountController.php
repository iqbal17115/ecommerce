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
        if($request->code) {
            $orders->where('status', $request->code);
        }

        return response()->json(['orders' => $orders]);
    }
    public function index()
    {
        $user = Auth::user();
        return view('ecommerce.my-account.my-account', compact('user'));
    }
}
