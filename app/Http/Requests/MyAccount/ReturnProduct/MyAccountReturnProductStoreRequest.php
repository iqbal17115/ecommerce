<?php

namespace App\Http\Requests\MyAccount\ReturnProduct;

use Illuminate\Foundation\Http\FormRequest;

class MyAccountReturnProductStoreRequest extends FormRequest
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
            'return_reason' => 'required|string',
            'refund_method' => 'required|string',
            'refund_amount' => 'required|numeric',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric',
            'products.*.subtotal' => 'required|numeric',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'products.*.product_id.exists' => 'One or more selected products do not exist.',
            'products.*.quantity.min' => 'Quantity must be at least 1.',
        ];
    }
}
