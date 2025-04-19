<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreCartItemRequest extends FormRequest
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
            'product_id' => 'required|uuid|exists:products,id',
            'product_variation_id' => 'nullable|uuid|exists:product_variations,id',
            'quantity' => 'nullable|integer|min:1',
            'is_buy_now' => 'nullable|boolean',
        ];
    }
}
