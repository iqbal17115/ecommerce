<?php
return [
    'columns' => [
        'id' => 'code',
        'title' => 'name',
        'description' => 'description',
        'availability' => 'is_active',
        'condition' => 'condition.name',
        'price' => 'your_price',
        'sale_price' => 'sale_price',
        'link' => 'link',
        'image_link' => 'images.0.url',
        'additional_image_link' => 'images.*.url',
        'brand' => 'brand.name',
        'google_product_category' => 'category.google_taxonomy',
        'product_type' => 'category.name',
        'item_group_id' => 'variation',
        'mpn' => 'model_number',
    ],
];
