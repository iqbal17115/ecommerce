<?php

return [

    "default_user_photo" => "images/user_icon.png",
    "spinner_path" => "images/spinner.png",

    "permissions" => [

        /**
         * Web
         */

        // User
        ["name" => "Lists", "route" => "users.lists", "type" => "users", "feature" => "web"],
        ["name" => "Store", "route" => "users.store", "type" => "users", "feature" => "web"],
        ["name" => "Update", "route" => "users.update", "type" => "users", "feature" => "web"],
        ["name" => "Delete", "route" => "users.delete", "type" => "users", "feature" => "web"],

        // Role
        ["name" => "Lists", "route" => "roles.lists", "type" => "roles", "feature" => "web"],
        ["name" => "Store", "route" => "roles.store", "type" => "roles", "feature" => "web"],
        ["name" => "Update", "route" => "roles.update", "type" => "roles", "feature" => "web"],
        ["name" => "Delete", "route" => "roles.delete", "type" => "roles", "feature" => "web"],

        // Product
        ["name" => "Lists", "route" => "product-product", "type" => "product", "feature" => "web"],
        ["name" => "Store", "route" => "product-product", "type" => "product", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.product", "type" => "product", "feature" => "web"],

        // Category
        ["name" => "Lists", "route" => "product-category", "type" => "category", "feature" => "web"],
        ["name" => "Store", "route" => "add.category", "type" => "category", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.category", "type" => "category", "feature" => "web"],

        // Brand
        ["name" => "Lists", "route" => "product-brand", "type" => "brands", "feature" => "web"],
        ["name" => "Store", "route" => "add.brand", "type" => "brands", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.brand", "type" => "brands", "feature" => "web"],

        // Unit
        ["name" => "Lists", "route" => "product-unit", "type" => "units", "feature" => "web"],
        ["name" => "Store", "route" => "add.unit", "type" => "units", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.unit", "type" => "units", "feature" => "web"],

        // Material
        ["name" => "Lists", "route" => "product-material", "type" => "materials", "feature" => "web"],
        ["name" => "Store", "route" => "add.material", "type" => "materials", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.material", "type" => "materials", "feature" => "web"],

        // Condition
        ["name" => "Lists", "route" => "condition", "type" => "conditions", "feature" => "web"],
        ["name" => "Store", "route" => "add.condition", "type" => "conditions", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.condition", "type" => "conditions", "feature" => "web"],

        // Feature
        ["name" => "Lists", "route" => "feature", "type" => "features", "feature" => "web"],
        ["name" => "Store", "route" => "add.feature", "type" => "features", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.feature", "type" => "features", "feature" => "web"],

        // Basic Info
        ["name" => "Show", "route" => "company-info", "type" => "company_info", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.company_vital_info", "type" => "Vital Info", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.add_link", "type" => "Add Link", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.about_us", "type" => "About Us", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.terms_condition", "type" => "Terms & Condition", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.privacy_policy", "type" => "Privacy Policy", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.add.return_policy", "type" => "Return Policy", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.shipping_and_delivery", "type" => "Shipping & Delivery", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.title", "type" => "Title", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.key_word", "type" => "Keyword", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.description", "type" => "Description", "feature" => "web"],
        ["name" => "Store Or Update", "route" => "add.status", "type" => "Status", "feature" => "web"],

        // Country
        ["name" => "Lists", "route" => "shop_setting_countries.lists", "type" => "countries", "feature" => "web"],
        ["name" => "Store", "route" => "countries.store", "type" => "countries", "feature" => "web"],
        ["name" => "Update", "route" => "countries.update", "type" => "countries", "feature" => "web"],
        ["name" => "Delete", "route" => "countries.delete", "type" => "countries", "feature" => "web"],

        // Division
        ["name" => "Lists", "route" => "shop_setting_divisions.lists", "type" => "divisions", "feature" => "web"],
        ["name" => "Store", "route" => "divisions.store", "type" => "divisions", "feature" => "web"],
        ["name" => "Update", "route" => "divisions.update", "type" => "divisions", "feature" => "web"],
        ["name" => "Delete", "route" => "divisions.delete", "type" => "divisions", "feature" => "web"],

        // District
        ["name" => "Lists", "route" => "shop_setting_districts.lists", "type" => "districts", "feature" => "web"],
        ["name" => "Store", "route" => "districts.store", "type" => "districts", "feature" => "web"],
        ["name" => "Update", "route" => "districts.update", "type" => "districts", "feature" => "web"],
        ["name" => "Delete", "route" => "districts.delete", "type" => "districts", "feature" => "web"],

        // Upazila
        ["name" => "Lists", "route" => "shop_setting_upazilas.lists", "type" => "upazilas", "feature" => "web"],
        ["name" => "Store", "route" => "upazilas.store", "type" => "upazilas", "feature" => "web"],
        ["name" => "Update", "route" => "upazilas.update", "type" => "upazilas", "feature" => "web"],
        ["name" => "Delete", "route" => "upazilas.delete", "type" => "upazilas", "feature" => "web"],

        // Currency
        ["name" => "Lists", "route" => "currency", "type" => "currency", "feature" => "web"],
        ["name" => "Store", "route" => "add.currency", "type" => "currency", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.currency", "type" => "currency", "feature" => "web"],

        // Slider
        ["name" => "Lists", "route" => "slider", "type" => "slider", "feature" => "web"],
        ["name" => "Store", "route" => "add.slider", "type" => "slider", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.slider", "type" => "slider", "feature" => "web"],

        // Advertisement
        ["name" => "Lists", "route" => "advertisement", "type" => "advertisement", "feature" => "web"],
        ["name" => "Store", "route" => "add.advertisement", "type" => "advertisement", "feature" => "web"],
        ["name" => "Delete", "route" => "delete.slider", "type" => "advertisement", "feature" => "web"],

        // Coupon
        ["name" => "Lists", "route" => "coupons.lists", "type" => "coupon", "feature" => "web"],
        ["name" => "Store", "route" => "coupons.store", "type" => "coupon", "feature" => "web"],
        ["name" => "Update", "route" => "coupons.update", "type" => "coupon", "feature" => "web"],
        ["name" => "Delete", "route" => "coupons.destroy", "type" => "coupon", "feature" => "web"],
    ],

    "system_permissions" => [
        "departments" => [
            "departments.show",
            "departments.select_lists"
        ],
        "institutes" => [
            "institutes.show",
            "institutes.select_lists"
        ],
        "companies" => [
            "companies.show",
            "companies.select_lists"
        ],
        "users" => [
            "users.show"
        ],
        "roles" => [
            "roles.show",
            "role_permissions",
            "permissions.show"
        ],
        "manage_groups" => [
            "manage_groups.show"
        ]
    ],

    'global_roles' => [
        [
            'name' => 'Super Admin',
            'details' => '',
            'is_permanent' => true,
            'is_admin' => true,
            'is_registered' => false,
            'type' => 'global'
        ],
        [
            'name' => 'Admin',
            'details' => '',
            'is_permanent' => true,
            'is_admin' => false,
            'is_registered' => false,
            'type' => 'global'
        ],
        [
            'name' => 'User',
            'details' => '',
            'is_permanent' => true,
            'is_admin' => false,
            'is_registered' => true,
            'type' => 'global'
        ]
    ],

    'feature_roles' => [
        [
            'name' => 'Admin',
            'details' => 'Facebook access with full control',
            'is_permanent' => true,
            'is_admin' => true,
            'is_registered' => false,
            'type' => 'feature'
        ],
        [
            'name' => 'Editor',
            'details' => 'Facebook access with partial control',
            'is_permanent' => true,
            'is_admin' => false,
            'is_registered' => false,
            'type' => 'feature'
        ],
        [
            'name' => 'Moderator',
            'details' => 'Task access for Message Replies, Community Activity, Ads, Insights',
            'is_permanent' => true,
            'is_admin' => false,
            'is_registered' => false,
            'type' => 'feature'
        ],
        [
            'name' => 'Member',
            'details' => 'Only Display posts',
            'is_permanent' => true,
            'is_admin' => false,
            'is_registered' => false,
            'type' => 'feature'
        ]
    ],

    'users' => [
        [
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'phone' => '017177777771',
            'password' => '123456789',
            'roles' => ["Super Admin", "User"]
        ],
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '017188888881',
            'password' => '123456789',
            'roles' => ["Admin", "User"]
        ],
        [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '017199999991',
            'password' => '123456789',
            'roles' => ["User"]
        ],
    ],
];
