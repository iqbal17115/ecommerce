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
            'order_detail_ids' => 'required|array',
            'previous_quantities' => 'required|array',
            'new_quantities' => 'array',
        ];
    }
}
