<?php

namespace App\Http\Requests\OrderEdit;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderAddressRequest extends FormRequest
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
            'street' => 'required|string|max:500',
            'district' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'optional_mobile' => 'nullable|string|max:20',
        ];
    }
}
