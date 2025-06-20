<?php

namespace App\Http\Requests\User\Product;

use App\Helpers\RequestHelper;
use Illuminate\Foundation\Http\FormRequest;

class ProductListRequest extends FormRequest
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
        return array_merge(RequestHelper::getCommonRulesForRequestLists(), [
            'type' => ['nullable'],
            'brand_id' => ['nullable'],
            'category_id' => ['nullable'],
            'sale_unit_id' => ['nullable'],
            'purchase_unit_id' => ['nullable']
        ]);
    }
}
