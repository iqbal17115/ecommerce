<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Enums\DayOfWeekEnum;
use App\Http\Controllers\Controller;
use App\Models\Address\Country;
use App\Models\Address\District;
use App\Models\Address\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function wishlist() {
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
        return view('ecommerce.my-account.my-account', compact('user_id', 'user', 'countries', 'divisions', 'districts', 'day_of_weeks', 'type'));
    }
}
