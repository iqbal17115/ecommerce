<?php

namespace App\Http\Requests\Order\OrderProduct;

use Illuminate\Foundation\Http\FormRequest;

class OrderProductCancellationRequest extends FormRequest
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
            'order_detail_id.*' => 'required_if:new_quantity.*,!=,null|exists:order_details,id',
            'previous_quantity.*' => 'required_if:new_quantity.*,!=,null|integer|min:0',
            'new_quantity.*' => 'nullable|string|max:255',
        ];


    }
}
