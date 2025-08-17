<?php

namespace App\Http\Requests\AdminPanel\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRateUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'min_weight' => ['nullable', 'numeric', 'min:0'],
            'max_weight' => ['nullable', 'numeric', 'gte:min_weight'],
            'min_amount' => ['nullable', 'numeric', 'min:0'],
            'max_amount' => ['nullable', 'numeric', 'gte:min_amount'],
            'min_qty'    => ['nullable', 'integer', 'min:0'],
            'max_qty'    => ['nullable', 'integer', 'gte:min_qty'],
            'rate'       => ['nullable', 'numeric', 'min:0'],
            'is_active'  => ['nullable', 'boolean'],
            'priority'   => ['nullable', 'integer', 'min:0'],
        ];
    }
}
