<?php

return [

    'site_title' => '',

    'models_namespace' => 'App\\Models',

    'home_uri' => 'admin',

    'navigation' => [
        'primary' => [
            [
                'title' => 'Users',
                'uri' => 'users',
                'icon' => 'uk-icon-users'
            ]
        ],
        'shortcuts' => [
            [
                'title' => 'New User',
                'uri' => 'admin/users/create',
                'icon' => 'uk-icon-plus'
            ]
        ]
    ],

    'resources' => [
        'users' => [
            'title' => 'Users',
            'model' => 'User',
            'fields' => [
                [
                    'title' => 'Email',
                    'name' => 'email',
                    'type' => 'email',
                    'validation' => 'required|email'
                ]
            ]
        ]
    ]

];
