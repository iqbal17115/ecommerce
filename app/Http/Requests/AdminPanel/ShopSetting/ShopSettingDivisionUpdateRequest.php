<?php

namespace App\Http\Requests\AdminPanel\ShopSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopSettingDivisionUpdateRequest extends FormRequest
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
        $divisionId = $this->route('division');
        return [
            'country_id' => 'required',
            'name' => ['required', 'max:100', Rule::unique('divisions', 'name')->ignore($divisionId)->whereNull('deleted_at')]
        ];
    }
}
