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
        'Change Status' => ['title' => 'Change Status', 'sorting' => true],
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
        'change_status' => ['title' => 'Change Status', 'sorting' => true],
        'is_active' => ['title' => 'Status', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'coupon_products' => [
        'coupon' => ['title' => 'Coupon', 'sorting' => true],
        'product' => ['title' => 'Products', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'roles' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'details' => ['title' => 'Details', 'sorting' => true],
        'is_permanent' => ['title' => 'Is Permanent', 'sorting' => true],
        'is_admin' => ['title' => 'Is Admin', 'sorting' => true],
        'is_registered' => ['title' => 'Is Registered', 'sorting' => true],
        'created_at' => ['title' => 'Created At', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false]
    ],
];
