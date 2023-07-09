<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('ecommerce.my-account.my-account', compact('user'));
    }
}
