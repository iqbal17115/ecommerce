<?php

namespace App\Http\Requests\SeoPage;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeoPageRequest extends FormRequest
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
            'url' => 'required|unique:seo_pages',
            'image' => 'required',
            'description' => 'required',
            'keyword' => 'required',
            'is_image_active' => 'required|boolean',
            'is_icon_active' => 'required|boolean',
            'is_date_active' => 'required|boolean'
        ];
    }
}
