<?php

namespace App\Http\Requests\Order\MyAccount\Address;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
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
            'address_id' => 'required',
            'user_id' => 'nullable',
            'country_id' => 'nullable',
            'name' => 'nullable',
            'instruction' => 'nullable',
            'mobile' => 'nullable',
            'optional_mobile' => 'nullable',
            'division_id' => 'nullable',
            'district_id' => 'nullable',
            'upazila_id' => 'nullable',
            'instruction' => 'nullable',
            'street_address' => 'nullable',
            'building_name' => 'nullable',
            'nearest_landmark' => 'nullable',
            'type' => 'nullable',
            'is_default' => 'nullable',
        ];
    }
}
