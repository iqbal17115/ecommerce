<?php

namespace App\Http\Requests\User\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderPlaceRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'mobile'           => 'required|string',
            'division'        => 'required|uuid',
            'district'        => 'required|uuid',
            'thana'           => 'required|uuid',
            'address'         => 'required|string|max:500',
            'payment_method'  => 'required|in:cod',
        ];
    }
}
