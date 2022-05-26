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
    ],
];
