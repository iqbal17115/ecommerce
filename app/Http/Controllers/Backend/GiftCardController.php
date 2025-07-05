<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{
    public function view()
    {
        return view('backend.gift_cards.index');
    }
}
