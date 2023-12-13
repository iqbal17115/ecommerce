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
            'country_id' => 'required',
            'name' => 'required',
            'instruction' => 'nullable',
            'mobile' => 'required',
            'optional_mobile' => 'nullable',
            'division_id' => 'required',
            'district_id' => 'required',
            'street_address' => 'required',
            'building_name' => 'required',
            'nearest_landmark' => 'required',
            'type' => 'required',
            'is_default' => 'required',
        ];
    }
}
