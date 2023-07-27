<?php

namespace App\Http\Requests\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class ShippingChargeRequest extends FormRequest
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
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'shipping_class' => 'required',
            'from_area' => 'required|numeric',
            'to_area' => 'required|numeric',
            'from_weight' => 'required|numeric',
            'to_weight' => 'required|numeric',
            'charge' => 'required|numeric',
            'min_quantity' => 'nullable|integer',
            'max_quantity' => 'nullable|integer',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'free_shipping' => 'required|in:yes,no',
            'minimum_amount_for_free_shipping' => 'nullable|numeric',
        ];
    }
}
