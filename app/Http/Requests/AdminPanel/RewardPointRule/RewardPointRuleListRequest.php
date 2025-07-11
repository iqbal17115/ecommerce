<?php

namespace App\Http\Requests\AdminPanel\RewardPointRule;

use App\Helpers\RequestHelper;
use Illuminate\Foundation\Http\FormRequest;

class RewardPointRuleListRequest extends FormRequest
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
        return RequestHelper::getCommonRulesForRequestLists();
    }
}
