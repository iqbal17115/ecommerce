<?php

namespace App\Http\Requests\User\UserAddress;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateUserAddressRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            'street_address' => 'nullable|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'nearest_landmark' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:20',
            'optional_mobile' => 'nullable|string|max:20',
            'is_default' => 'boolean',
            'country_id' => 'required|exists:countries,id',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
        ];
    }
}
