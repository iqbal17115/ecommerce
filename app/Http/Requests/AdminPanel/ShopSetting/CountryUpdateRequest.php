<?php

namespace App\Http\Requests\AdminPanel\ShopSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryUpdateRequest extends FormRequest
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
        $countryId = $this->route('country');

        return [
            'name' => ['required', 'max:100', Rule::unique('countries', 'name')->ignore($countryId)->whereNull('deleted_at')]
        ];
    }
}
