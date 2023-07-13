<?php

namespace App\Http\Requests\SeoPage;

use Illuminate\Foundation\Http\FormRequest;

class SeoUpdateRequest extends FormRequest
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
        return [
            'title' => 'required',
            'description' => 'required',
            'keyword' => 'required',
            'date' => 'nullable',
            'is_image_active' => 'required|boolean',
            'is_icon_active' => 'required|boolean',
        ];
    }
}
