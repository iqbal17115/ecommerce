<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SelectListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return  [
            'search' => ['nullable'],
            'page' => ['nullable'],
            'limit' => ['nullable'],
            'sort_by' => ['nullable'],
            'sort_order' => ['nullable']
        ];
    }
}
