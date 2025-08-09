<?php

namespace App\Http\Requests\AdminPanel\ShippingCharge;

use Illuminate\Foundation\Http\FormRequest;

class ShippingChargeStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'division_id' => ['nullable', 'exists:divisions,id'],
            'district_id' => ['nullable', 'exists:districts,id'],
            'upazila_id' => ['nullable', 'exists:upazilas,id'],
            'min_order_amount' => ['nullable', 'numeric', 'gte:0'],
            'max_order_amount' => ['nullable', 'numeric', 'gte:min_order_amount'],
            'min_weight' => ['nullable', 'numeric', 'gte:0'],
            'max_weight' => ['nullable', 'numeric', 'gte:min_weight'],
            'min_qty' => ['nullable', 'integer', 'gte:0'],
            'max_qty' => ['nullable', 'integer', 'gte:min_qty'],
            'charge_amount' => ['required', 'numeric', 'gte:0'],
            'is_active' => ['boolean'],
        ];
    }
}
