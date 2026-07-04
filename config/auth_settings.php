<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Settings
    |--------------------------------------------------------------------------
    */

    'auto_login_after_registration' => env('AUTO_LOGIN_AFTER_REGISTRATION', true),

    'verification' => [
        'require' => env('REQUIRE_EMAIL_VERIFICATION', true),
    ],

    'throttle' => [
        'login' => env('LOGIN_THROTTLE_ATTEMPTS', 5),
        'login_decay' => env('LOGIN_THROTTLE_DECAY_MINUTES', 1),
    ],
];
