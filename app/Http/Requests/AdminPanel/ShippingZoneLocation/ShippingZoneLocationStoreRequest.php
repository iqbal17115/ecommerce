<?php

namespace App\Http\Requests\AdminPanel\ShippingZoneLocation;

use Illuminate\Foundation\Http\FormRequest;

class ShippingZoneLocationStoreRequest extends FormRequest
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
            'shipping_zone_id' => ['required', 'exists:shipping_zones,id'],
            'locations' => ['required', 'array', 'min:1'],
            'locations.*.division_id' => ['required', 'exists:divisions,id'],
            'locations.*.district_id' => ['required', 'exists:districts,id'],
            'locations.*.upazila_ids' => ['required', 'array', 'min:1'],
            'locations.*.upazila_ids.*' => ['exists:upazilas,id'],
        ];
    }
}
