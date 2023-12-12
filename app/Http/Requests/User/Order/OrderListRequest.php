<?php

namespace App\Http\Requests\User\Order;

use App\Helpers\RequestHelper;
use Illuminate\Foundation\Http\FormRequest;

class OrderListRequest extends FormRequest
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
            'code' => 'nullable',
        ];
    }
}
