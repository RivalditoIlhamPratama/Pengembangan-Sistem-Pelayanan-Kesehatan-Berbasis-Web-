<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'pasien' => [  // Update this to use the new provider
            'driver' => 'session',
            'provider' => 'pasiens',
        ],
        'dokter' => [
            'driver' => 'session',
            'provider' => 'dokters',
        ],
        'stafrekammedis' => [
            'driver' => 'session',
            'provider' => 'staffrekammedis',
        ],
        'klinik' => [
            'driver' => 'session',
            'provider' => 'kliniks',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'pasiens' => [  // Add this new provider
            'driver' => 'eloquent',
            'model' => App\Models\pasien::class,
        ],
        'dokters' => [  // Add this new provider
            'driver' => 'eloquent',
            'model' => App\Models\dokter::class,
        ],
        'stafrekammedis' => [  // Add this new provider
            'driver' => 'eloquent',
            'model' => App\Models\Staffrekammedis::class,
        ],
        'kliniks' => [
            'driver' => 'eloquent',
            'model' => App\Models\klinik::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
