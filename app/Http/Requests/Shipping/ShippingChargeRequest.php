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
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'charge' => 'required|numeric',
            'min_quantity' => 'nullable|integer',
            'max_quantity' => 'nullable|integer',
            'area' => 'nullable|integer',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'free_shipping' => 'nullable',
            'minimum_amount_for_free_shipping' => 'nullable|numeric',
            'maximum_amount_for_free_shipping' => 'nullable|numeric',
        ];
    }
}
