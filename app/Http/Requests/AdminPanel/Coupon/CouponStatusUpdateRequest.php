<?php

namespace App\Http\Requests\AdminPanel\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class CouponStatusUpdateRequest extends FormRequest
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
            'is_active' => 'required'
        ];
    }
}
