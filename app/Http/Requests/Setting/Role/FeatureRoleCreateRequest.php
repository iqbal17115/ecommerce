<?php

namespace App\Http\Requests\Setting\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeatureRoleCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', Rule::unique('roles')->whereNull('deleted_at')],
            'details' => 'nullable',
            'type' => 'required',
            //'is_permanent' => 'boolean',
           // 'is_admin' => 'boolean'
        ];
    }
}
