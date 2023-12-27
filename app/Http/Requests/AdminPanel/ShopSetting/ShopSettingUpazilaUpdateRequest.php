<?php

namespace App\Http\Requests\AdminPanel\ShopSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopSettingUpazilaUpdateRequest extends FormRequest
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
        $upazilaId = $this->route('upazila');
        return [
            'district_id' => 'required',
            'name' => ['required', 'max:100', Rule::unique('upazilas', 'name')->ignore($upazilaId)->whereNull('deleted_at')]
        ];
    }
}
