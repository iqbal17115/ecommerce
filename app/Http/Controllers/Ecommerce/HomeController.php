<?php

namespace App\Http\Controllers\Ecomerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('ecommerce.home');
    }
}
