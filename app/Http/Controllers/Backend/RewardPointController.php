<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class RewardPointController extends Controller
{
    public function view()
    {
        return view('backend.reward_points.index');
    }
}
