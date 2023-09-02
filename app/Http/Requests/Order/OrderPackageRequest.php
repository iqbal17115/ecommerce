<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class OrderPackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [];

        foreach ($request->input('package_weight') as $key => $value) {
            $rules['package_weight.' . $key] = 'required|numeric';
            $rules['weight_unit.' . $key] = 'required';
            $rules['length.' . $key] = 'required|numeric';
            $rules['length_unit.' . $key] = 'required';
            $rules['height.' . $key] = 'required|numeric';
            $rules['height_unit.' . $key] = 'required';
        }

        foreach ($request->input('product_expected_qty') as $key => $value) {
            $rules['box_number.' . $key] = 'required';
            $rules['product_id.' . $key] = 'required';
            $rules['product_name.' . $key] = 'required';
            $rules['product_expected_qty.' . $key] = 'required|numeric';
        }

        return $rules;
    }
}
