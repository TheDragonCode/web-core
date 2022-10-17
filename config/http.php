<?php

return [
    'middleware' => [
        'verify_csrf' => [
            'except' => [],
        ],

        'encrypt_cookies' => [
            'except' => [],
        ],

        'redirect' => [
            'authenticated' => '/home',
        ],

        'maintenance' => [
            'except' => [],
        ],
    ],

    'response' => [
        'json' => 'api',
    ],

    'throttle' => 120,

    'prefixes' => [
        'api' => null,
        'web' => null,
    ],
];
