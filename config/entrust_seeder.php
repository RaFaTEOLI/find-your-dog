<?php

return [
    'role_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'admin' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'profile' => 'r,d',
            'lost_dogs' => 'c,r,u,d',
            'found_dogs' => 'c,r,u,d'
        ],
        'finder' => [
            'profile' => 'r,u',
            'lost_dogs' => 'c,r,u,d',
            'found_dogs' => 'c,r,u,d'
        ],
    ],
    'user_roles' => [
        'admin' => [
            ['name' => "Admin", "email" => "admin@findyourdog.com", "password" => '123456'],
        ],
        'finder' => [
            ['name' => "John Doe", "email" => "johndoe@findyourdog.com", "password" => '123456'],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
