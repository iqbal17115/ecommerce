<?php

namespace App\Http\Requests\MyAccount\ReturnProduct;

use App\Rules\MyAccount\ValidReturnQuantity;
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
            'order_id' => 'required|exists:orders,id', // Validate order_id exists in orders table
            'return_reason' => 'required|string',
            'refund_method' => 'required|string',
            'refund_amount' => 'required|numeric',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => ['required', 'integer', 'min:1', function ($attribute, $value, $fail) {
                $index = explode('.', $attribute)[1]; // Get the index of the product in the array
                $orderDetailId = $this->input('products.' . $index . '.order_detail_id');

                if (!is_null($orderDetailId)) {
                    if (!(new ValidReturnQuantity($orderDetailId))->passes($attribute, $value)) {
                        $fail('The return quantity must be less than or equal to the ordered quantity.');
                    }
                }
            }],
            'products.*.unit_price' => 'required|numeric',
            'products.*.subtotal' => 'required|numeric',
            'products.*.order_detail_id' => 'required|exists:order_details,id', //Validate order_detail_id.
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
            'order_id.exists' => 'The selected order does not exist.',
            'products.*.order_detail_id.exists' => 'One or more selected order details do not exist.',
        ];
    }
}
