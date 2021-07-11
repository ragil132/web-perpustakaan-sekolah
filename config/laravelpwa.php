<?php

return [
    'name' => 'Perpus SMK Muhammadiyah 7 Jakarta',
    'manifest' => [
        'name' => env('APP_NAME', 'Perpus SMK Muhammadiyah 7 Jakarta'),
        'short_name' => 'Perpus SMK Muhammadiyah 7 Jakarta',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#58d8a3',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> '#58d8a3',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/logo3.png',
            '750x1334' => '/images/logo3.png',
            '828x1792' => '/images/logo3.png',
            '1125x2436' => '/images/logo3.png',
            '1242x2208' => '/images/logo3.png',
            '1242x2688' => '/images/logo3.png',
            '1536x2048' => '/images/logo3.png',
            '1668x2224' => '/images/logo3.png',
            '1668x2388' => '/images/logo3.png',
            '2048x2732' => '/images/logo3.png',
        ],
        'shortcuts' => [],
        'custom' => []
    ]
];
