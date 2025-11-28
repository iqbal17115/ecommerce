<?php

namespace App\Http\Requests\AdminPanel\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends StoreProductRequest
{
    public function rules(): array
    {
        return parent::rules(); // Same rules for now
    }
}
