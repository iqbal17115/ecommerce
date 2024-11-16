<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
        $roleId = $this->route('role');

        return [
            'name' => [
                'required', 'max:50', Rule::unique('roles')->ignore($roleId)->whereNull('deleted_at'),
            ],
            'details' => 'nullable',
            //'is_permanent' => 'boolean',
            //'is_admin' => 'boolean',
        ];
    }
}
