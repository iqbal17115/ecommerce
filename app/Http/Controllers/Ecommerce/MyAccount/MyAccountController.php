<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Enums\DayOfWeekEnum;
use App\Http\Controllers\Controller;
use App\Models\Address\Country;
use App\Models\Address\District;
use App\Models\Address\Division;
use App\Models\FrontEnd\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function wishlist()
    {
        $user = Auth::user();
        $countries =  Country::get();
        $divisions =  Division::get();
        $districts =  District::get();
        $day_of_weeks = DayOfWeekEnum::getDaysOfWeek();
        $user_id = auth()?->user()->id ?? null;
        $wishlist_status = "active";
        return view('ecommerce.my-account.my-account', compact('user_id', 'user', 'countries', 'divisions', 'districts', 'day_of_weeks', 'wishlist_status'));
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $countries =  Country::get();
        $divisions =  Division::get();
        $districts =  District::get();
        $day_of_weeks = DayOfWeekEnum::getDaysOfWeek();
        $user_id = auth()?->user()->id ?? null;
        $type = $request->type ?? null;

        // Fetch user balances (Assuming balance is stored somewhere)
        $userBalance = $user->balance ?? 0.00;

        // Fetch user's total purchases
        $totalPurchase = Order::where('user_id', $user->id)
            ->sum('total_amount');

        // Fetch user's total returns (Assuming returned orders have a specific status)
        $totalReturns = Order::where('user_id', $user->id)
            ->where('status', 'returned') // Adjust according to your enum
            ->sum('total_amount');

        // Fetch user's total refunds
        $totalRefunds = OrderPayment::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('total_receive_amount');

        // Fetch user's total rewards (Assuming rewards are stored somewhere)
        $totalRewards = $user->rewards ?? 0.00;


        // Fetch user's total payments made
        $totalPayments = OrderPayment::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('amount_paid');

        // Fetch total discounts received
        $totalDiscounts = OrderPayment::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('total_discount_amount');

        // Fetch total shipping charges paid
        $totalShippingCharges = OrderPayment::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('total_shipping_charge_amount');

        // Fetch total due amount
        $totalDueAmount = OrderPayment::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('due_amount');

        // Fetch total order count
        $totalOrders = Order::where('user_id', $user->id)->count();

        return view('ecommerce.my-account.my-account', compact(
            'user_id',
            'user',
            'countries',
            'divisions',
            'districts',
            'day_of_weeks',
            'type',
            'userBalance',
            'totalPurchase',
            'totalReturns',
            'totalRefunds',
            'totalPayments',
            'totalDiscounts',
            'totalShippingCharges',
            'totalDueAmount',
            'totalOrders'
        ));
    }
}
