<?php

namespace App\Http\Requests\AdminPanel\ShopSetting;

use Illuminate\Foundation\Http\FormRequest;

class ShopSettingAddressInstructionRequest extends FormRequest
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
            'property' => 'required|in:House,Apartment,Business,Other',
            'deliveryDays.Sunday' => 'required|in:open,closed',
            'deliveryDays.Monday' => 'required|in:open,closed',
            'deliveryDays.Tuesday' => 'required|in:open,closed',
            'deliveryDays.Wednesday' => 'required|in:open,closed',
            'deliveryDays.Thursday' => 'required|in:open,closed',
            'deliveryDays.Friday' => 'required|in:open,closed',
            'deliveryDays.Saturday' => 'required|in:open,closed'
        ];
    }
}
