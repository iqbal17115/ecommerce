<?php

namespace App\Http\Requests\AdminPanel\Shipping;

use Illuminate\Foundation\Http\FormRequest;

class InsideOutsideStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping_zone_id' => ['required', 'uuid', 'exists:shipping_zones,id'],
            'inside_rate'      => ['required', 'numeric', 'min:0'],
            'outside_rate'     => ['required', 'numeric', 'min:0'],
        ];
    }
}
