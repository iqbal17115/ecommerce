<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function index() {
        return view('backend.setting.manage-company');
    }
}
