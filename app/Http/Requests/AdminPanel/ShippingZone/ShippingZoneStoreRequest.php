<?php

namespace App\Http\Requests\AdminPanel\ShippingZone;

use Illuminate\Foundation\Http\FormRequest;

class ShippingZoneStoreRequest extends FormRequest
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
        $zoneId = $this->route('id') ?? null;

        return [
            'name' => 'required|string',
            'type' => 'required|in:inside_outside,location,mixed',
            'is_active' => 'nullable|boolean',
        ];
    }
}
