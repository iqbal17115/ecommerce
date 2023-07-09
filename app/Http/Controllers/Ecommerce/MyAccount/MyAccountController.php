<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function index() {
        return view('ecommerce.my-account.my-account');
    }
}
