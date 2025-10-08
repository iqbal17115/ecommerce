<?php
return [
    'columns' => [
        'id' => 'id',
        'title' => 'name',
        'description' => 'description',
        'availability' => 'is_active',
        'condition' => 'condition.name',
        'price' => 'your_price',
        'link' => 'product_link',
        'image_link' => 'images.0.url',
        'additional_image_link' => 'images.*.url',
        'brand' => 'brand.name',
        'google_product_category' => 'category.google_taxonomy',
        'product_type' => 'category.name',
        'mpn' => 'model_number',
    ],
];
