<?php

return [
    'countries' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'status' => ['title' => 'Status', 'sorting' => true],
        'change_status' => ['title' => 'Change Status', 'sorting' => true],
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
    'users' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'email' => ['title' => 'Email', 'sorting' => true],
        'mobile' => ['title' => 'Mobile', 'sorting' => true],
        'roles' => ['title' => 'Roles', 'sorting' => true],
        'created_at' => ['title' => 'Created At', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false]
    ],
    'reward_point_rules' => [
        'event' => ['title' => 'Event', 'sorting' => true],
        'points' => ['title' => 'Points', 'sorting' => true],
        'multiplier' => ['title' => 'Multiplier', 'sorting' => true],
        'status' => ['title' => 'Status', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],
    'gift_cards' => [
        'code' => ['title' => 'Code', 'sorting' => true],
        'amount' => ['title' => 'Amount', 'sorting' => true],
        'balance' => ['title' => 'Balance', 'sorting' => true],
        'status' => ['title' => 'Status', 'sorting' => true],
        'recipient_email' => ['title' => 'Recipient Email', 'sorting' => true],
        'expiration' => ['title' => 'Expiration', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'shipping_zones' => [
        'name' => ['title' => 'Name', 'sorting' => true],
        'type' => ['title' => 'Type', 'sorting' => true],
        'is_active' => ['title' => 'Status', 'sorting' => true],
        'actions' => ['title' => 'Action', 'sorting' => false],
    ],

    'shipping_zone_locations' => [
        'shipping_zone_name' => ['title' => 'Shipping Zone', 'sorting' => true],
        'division_name' => ['title' => 'Division', 'sorting' => true],
        'district_name' => ['title' => 'District', 'sorting' => true],
        'upazila_name' => ['title' => 'Upazila', 'sorting' => true],
    ],

    'shipping_rates' => [
        'shipping_zone_name' => ['title' => 'Shipping Zone', 'sorting' => true],
        'min_amount' => ['title' => 'Min Amount', 'sorting' => true],
        'max_amount' => ['title' => 'Max Amount', 'sorting' => true],
        'min_weight' => ['title' => 'Min Weight', 'sorting' => true],
        'max_weight' => ['title' => 'Max Weight', 'sorting' => true],
        'min_qty' => ['title' => 'Min Qty', 'sorting' => true],
        'max_qty' => ['title' => 'Max Qty', 'sorting' => true],
        'rate' => ['title' => 'Rate', 'sorting' => true],
    ],
];
