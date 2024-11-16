<?php

namespace App\Http\Requests\User\Cart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllCartItemStatusRequest extends FormRequest
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
            'user_id' => 'required',
            'is_checked' => 'boolean'
        ];
    }
}
