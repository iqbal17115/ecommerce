<?php

return [
    'countries' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'status' => ['title' => 'Status', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'divisions' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'Country' => ['title' => 'Country', 'sorting' => true],
        'status' => ['title' => 'Status', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'districts' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'Division' => ['title' => 'Division', 'sorting' => true],
        'Country' => ['title' => 'Country', 'sorting' => true],
        'Location' => ['title' => 'Location', 'sorting' => true],
        'Change Location' => ['title' => 'Change Location', 'sorting' => true],
        'status' => ['title' => 'Status', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'upazilas' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'District' => ['title' => 'District', 'sorting' => true],
        'status' => ['title' => 'Status', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'coupons' => [
        'code' => ['title' => 'Code', 'sorting' => true],
        'valid_from' => ['title' => 'Valid From', 'sorting' => true],
        'valid_to' => ['title' => 'Valid To', 'sorting' => true],
        'type' => ['title' => 'Type', 'sorting' => true],
        'value' => ['title' => 'Value', 'sorting' => true],
        'max_uses' => ['title' => 'Max Uses', 'sorting' => true],
        'is_active' => ['title' => 'is_active', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'coupon_products' => [
        'coupon' => ['title' => 'Coupon', 'sorting' => true],
        'product' => ['title' => 'Products', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],
];
