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
            'shipping_class_id' => 'required|exists:shipping_classes,id',
            'from_length' => 'required|numeric',
            'to_length' => 'required|numeric',
            'from_width' => 'required|numeric',
            'to_width' => 'required|numeric',
            'from_height' => 'required|numeric',
            'to_height' => 'required|numeric',
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
