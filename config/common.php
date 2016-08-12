<?php
return [
    'user' => [
        'role' => [
            'customer' => 0,
            'admin' => 1,
        ],
        'avatar_default' => '/images/default.png',
    ],

    'path_cloud_avatar' => 'foods/avatar/',
    'path_cloud_product' => 'foods/product/',

    'user_role' => [
        1 => 'Admin',
        0 => 'User',
    ],

    'status' => [
        1 => 'Enable',
        0 => 'Disable',
    ],

    'base_repository' => [
        'limit' => 10,
    ],

    'paginate' => 5,
    'parent' => 0,

    'category_parent' => [
    	1 => 'Foods',
    	2 => 'Drinks',
    ],

    'items_per_page' => 6,
    'currency' => '$',
    'unpaid' => 0,
    'none' => 0,

    'order_status' => [
        0 => 'Unpaid',
        1 => 'Paid',
        2 => 'Cancel',
    ],
];
