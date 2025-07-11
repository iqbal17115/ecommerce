<?php

namespace App\Http\Requests\AdminPanel\RewardPointRule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RewardPointRuleUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        // Get the current RewardPointRule ID from route
        $ruleId = $this->route('rewardPointRule')->id;

        return [
            'event' => [
                'required',
                'integer',
                'between:1,5',
                Rule::unique('reward_point_rules', 'event')->ignore($ruleId),
            ],
            'points' => [
                'required',
                'integer',
                'min:0',
            ],
            'multiplier' => [
                'nullable',
                'numeric',
                'between:1,99.99',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'event.required' => 'Please select an event.',
            'event.between' => 'Invalid event value.',
            'event.unique' => 'A rule for this event already exists.',
            'points.required' => 'Points are required.',
            'points.integer' => 'Points must be an integer.',
            'points.min' => 'Points must be at least 0.',
            'multiplier.numeric' => 'Multiplier must be a valid number.',
            'multiplier.between' => 'Multiplier must be between 1.00 and 99.99.',
        ];
    }
}
