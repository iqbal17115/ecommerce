<?php

namespace App\Http\Requests\AdminPanel\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRateStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // policy থাকলে সেট করো
    }

    public function rules(): array
    {
        return [
            'shipping_zone_id' => ['required', 'uuid', 'exists:shipping_zones,id'],
            'min_weight'       => ['nullable', 'numeric', 'min:0'],
            'max_weight'       => ['nullable', 'numeric', 'gte:min_weight'],
            'min_amount'       => ['nullable', 'numeric', 'min:0'],
            'max_amount'       => ['nullable', 'numeric', 'gte:min_amount'],
            'min_qty'          => ['nullable', 'integer', 'min:0'],
            'max_qty'          => ['nullable', 'integer', 'gte:min_qty'],
            'rate'             => ['required', 'numeric', 'min:0'],
            'is_active'        => ['nullable', 'boolean'],
            'priority'         => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_zone_id.required' => 'Shipping zone is required.',
            'shipping_zone_id.uuid'     => 'Invalid zone id.',
        ];
    }
}
