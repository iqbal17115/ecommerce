<?php

return [

    "spinner_path" => "images/spinner.png",

    "permissions" => [
        /**
         * Web
         */
        ["name" => "Company View", "route" => "companies.view", "type" => "companies", "feature" => "web"],
        ["name" => "Institute View", "route" => "institutes.view", "type" => "users", "feature" => "web"],
        ["name" => "Department View", "route" => "departments.view", "type" => "departments", "feature" => "web"],
        ["name" => "Roles View", "route" => "roles.view", "type" => "roles", "feature" => "web"],
        ["name" => "Users View", "route" => "users.view", "type" => "users", "feature" => "web"],

        //Manage Groups
        ["name" => "Manage Groups List View", "route" => "manage_groups.view", "type" => "manage_groups", "feature" => "web"],
        ["name" => "Manage Groups Create View", "route" => "manage_groups.create", "type" => "manage_groups", "feature" => "web"],
        ["name" => "Manage Groups Update View", "route" => "manage_groups.edit", "type" => "manage_groups", "feature" => "web"],

        //Manage Groups Posts
        ["name" => "Group Posts List View", "route" => "manage_group_posts.view", "type" => "manage_group_posts", "feature" => "web"],

        //Manage Groups Members
        ["name" => "Manage Group Members List View", "route" => "manage_group_members.view", "type" => "manage_group_members", "feature" => "web"],

        /**
         * Api
         */
        //companies
        ["name" => "Lists", "route" => "companies.lists", "type" => "companies", "feature" => "api"],
        ["name" => "Store", "route" => "companies.store", "type" => "companies", "feature" => "api"],
        ["name" => "Update", "route" => "companies.update", "type" => "companies", "feature" => "api"],
        ["name" => "Delete", "route" => "companies.delete", "type" => "companies", "feature" => "api"],

        //departments
        ["name" => "Lists", "route" => "departments.lists", "type" => "departments", "feature" => "api"],
        ["name" => "Store", "route" => "departments.store", "type" => "departments", "feature" => "api"],
        ["name" => "Update", "route" => "departments.update", "type" => "departments", "feature" => "api"],
        ["name" => "Delete", "route" => "departments.delete", "type" => "departments", "feature" => "api"],

        //institutes
        ["name" => "Lists", "route" => "institutes.lists", "type" => "institutes", "feature" => "api"],
        ["name" => "Store", "route" => "institutes.store", "type" => "institutes", "feature" => "api"],
        ["name" => "Update", "route" => "institutes.update", "type" => "institutes", "feature" => "api"],
        ["name" => "Delete", "route" => "institutes.delete", "type" => "institutes", "feature" => "api"],

        //users
        ["name" => "Lists", "route" => "users.lists", "type" => "users", "feature" => "api"],
        ["name" => "Store", "route" => "users.store", "type" => "users", "feature" => "api"],
        ["name" => "Update", "route" => "users.update", "type" => "users", "feature" => "api"],
        ["name" => "Delete", "route" => "users.delete", "type" => "users", "feature" => "api"],

        //roles
        ["name" => "Lists", "route" => "roles.lists", "type" => "roles", "feature" => "api"],
        ["name" => "Store", "route" => "roles.store", "type" => "roles", "feature" => "api"],
        ["name" => "Update", "route" => "roles.update", "type" => "roles", "feature" => "api"],
        ["name" => "Delete", "route" => "roles.delete", "type" => "roles", "feature" => "api"],
        ["name" => "Assign Permissions", "route" => "assign_permissions", "type" => "roles", "feature" => "api"],

        //manage groups
        ["name" => "Lists", "route" => "manage_groups.lists", "type" => "manage_groups", "feature" => "api"],
        ["name" => "Store", "route" => "manage_groups.store", "type" => "manage_groups", "feature" => "api"],
        ["name" => "Update", "route" => "manage_groups.update", "type" => "manage_groups", "feature" => "api"],
        ["name" => "Delete", "route" => "manage_groups.delete", "type" => "manage_groups", "feature" => "api"],
        ["name" => "Delete Group Questions", "route" => "group_questions.delete", "type" => "manage_groups", "feature" => "api"],
        ["name" => "Delete Group Question Options", "route" => "group_question_options.delete", "type" => "manage_groups", "feature" => "api"],

        //manage group posts
        ["name" => "Lists", "route" => "manage_group_posts.lists", "type" => "manage_group_posts", "feature" => "api"],
        ["name" => "Store", "route" => "manage_group_posts.store", "type" => "manage_group_posts", "feature" => "api"],
        ["name" => "Update", "route" => "manage_group_posts.update", "type" => "manage_group_posts", "feature" => "api"],
        ["name" => "Delete", "route" => "manage_group_posts.delete", "type" => "manage_group_posts", "feature" => "api"],
        ["name" => "Delete Group Questions", "route" => "group_questions.delete", "type" => "manage_groups", "feature" => "api"],

        //manage group members
        ["name" => "Lists", "route" => "manage_group_members.lists", "type" => "manage_group_members", "feature" => "api"],
        ["name" => "Update Join Request", "route" => "manage_group_members.update_join_request", "type" => "manage_groups", "feature" => "api"],
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
            'phone' => '01717777777',
            'password' => '123456789',
            'roles' => ["Super Admin", "User"]
        ],
        [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01718888888',
            'password' => '123456789',
            'roles' => ["Admin", "User"]
        ],
        [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '01719999999',
            'password' => '123456789',
            'roles' => ["User"]
        ],
    ],
];
