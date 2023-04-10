<?php

namespace App\Http\Controllers\Backend\Currency;

use App\Http\Controllers\Controller;
use App\Models\Backend\Currency\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function pagination(Request $request)
    {
        $currencies = Currency::latest()->paginate(10);
        return view('backend.product.pagination.currency', compact('currencies'))->render();
    }
    public function deleteCurrency(Request $request)
    {
        $currency = Currency::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addCurrency(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'icon' => 'required',
                'position' => 'required',
                'is_active' => 'required'
            ],
            [
                'name' => 'Name is required',
                'icon' => 'Icon is required',
                'position' => 'Position is required',
                'is_active' => 'Status is required'
            ]
        );
        if ($request->cu_id > 0) {
            $currency = Currency::find($request->cu_id);
        } else {
            $currency = new Currency();
        }

        $currency->name = $request->name;
        $currency->icon = $request->icon;
        $currency->position = $request->position;
        $currency->conversion_rate = $request->conversion_rate;
        $currency->is_default = $request->is_default;
        $currency->is_active = $request->is_active;
        $currency->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $currencies = Currency::latest()->paginate(10);
        return view('backend.currency.currency', compact('currencies'));
    }
}
