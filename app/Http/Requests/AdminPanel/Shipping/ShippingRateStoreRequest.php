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
            'rates' => ['required', 'array', 'min:1'],
            'rates.*.id' => ['nullable', 'uuid', 'exists:shipping_rates,id'],
            'rates.*.min_amount' => ['nullable', 'numeric', 'min:0'],
            'rates.*.max_amount' => ['nullable', 'numeric', 'gte:rates.*.min_amount'],
            'rates.*.min_weight' => ['nullable', 'numeric', 'min:0'],
            'rates.*.min_qty' => ['nullable', 'numeric', 'min:0'],
            'rates.*.max_qty' => ['nullable', 'numeric', 'gte:rates.*.min_qty'],
            'rates.*.max_weight' => ['nullable', 'numeric', 'gte:rates.*.min_weight'],
            'rates.*.rate' => ['required', 'numeric', 'min:0'],
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
