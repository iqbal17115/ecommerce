<?php

namespace App\Http\Requests\AdminPanel\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // --- 1. Basic Information & Product ---
            'product_name' => ['required', 'string', 'max:255'],
            // Check if category_id is a valid UUID and exists
            'category_id' => ['required', 'uuid', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'highlights' => ['nullable', 'string'],
            'brand_id' => ['nullable', 'uuid', 'exists:brands,id'],
            'product_feature_id' => ['nullable', 'uuid', 'exists:product_features,id'],

            // --- 2. Media ---
            // Gallery images validation (max 8 files)
            'gallery_images' => ['nullable', 'array', 'max:8'],
            'gallery_images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'], // Max 2MB

            // Single promo image validation
            'promo_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],

            // Video link and source validation
            // 'video_source' => ['nullable', 'in:youtube,media_center'],
            // 'video_link' => ['nullable', 'url', 'max:255', 'required_if:video_source,youtube'],

            // --- 3. Shipping & Warranty ---
            'package_weight' => ['required', 'numeric', 'min:0.001', 'max:300'],
            'weight_unit' => ['required', 'in:kg,g'],

            // Package Dimensions (Length, Width, Height)
            'length' => ['required', 'numeric', 'min:0.01', 'max:300'],
            'width' => ['required', 'numeric', 'min:0.01', 'max:300'],
            'height' => ['required', 'numeric', 'min:0.01', 'max:300'],

            'dangerous_goods' => ['required', 'in:none,contains'],
            'warranty_type' => ['nullable', 'string', 'max:100'],
            'warranty' => ['nullable', 'string', 'max:100'],
            'warranty_policy' => ['nullable', 'string', 'max:500'],

            // --- 4. Variant Definition (Used to define variant names/attributes) ---
            'variant_name_1' => ['nullable', 'string', 'max:100'],
            'variant_name_2' => ['nullable', 'string', 'max:100'],

            // --- 5. Combinations (Price, Stock, SKU table) ---
            // This array holds the final row data generated from the variant table.
            'combinations' => ['required', 'array', 'min:1'],

            // Validation for each item inside the 'combinations' array
            'combinations.*.price' => ['required', 'numeric', 'min:0.01'],
            'combinations.*.special_price' => ['nullable', 'numeric', 'min:0.01', 'lt:combinations.*.price'],
            'combinations.*.stock' => ['required', 'integer', 'min:0'],
            'combinations.*.seller_sku' => ['required', 'string', 'max:100', 'distinct'], // Must be unique across all combinations

            // The option values are needed to reconstruct the combination link (e.g., [Red, Small])
            'combinations.*.option_values' => ['required', 'array', 'min:1'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'A product category must be selected.',
            'category_id.exists' => 'The selected category is invalid.',

            'gallery_images.max' => 'You can upload a maximum of 8 gallery images.',
            'gallery_images.*.image' => 'All uploaded gallery files must be valid images.',

            'package_weight.required' => 'The package weight is required.',
            'length.required' => 'Package dimensions (Length, Width, and Height) are required.',

            'combinations.min' => 'You must define at least one price/stock combination in the variant table.',
            'combinations.*.price.required' => 'Price is required for every product combination.',
            'combinations.*.stock.required' => 'Stock quantity is required for every product combination.',
            'combinations.*.seller_sku.distinct' => 'Each Seller SKU must be unique across all combinations.',
            'combinations.*.special_price.lt' => 'Special Price must be less than the regular Price.',
        ];
    }
}
