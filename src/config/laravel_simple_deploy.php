<?php

return [

    'secret' => env('LARAVEL_SIMPLE_DEPLOYER__SECRET'),

    'enabled' => env('LARAVEL_SIMPLE_DEPLOYER__ENABLED', true),

    'branch' => env('LARAVEL_SIMPLE_DEPLOYER__BRANCH', 'master'),

    'git_update' => env('LARAVEL_SIMPLE_DEPLOYER__GIT_UPDATE', true),

    'custom_artisan_command' => [

        /*'Cache' => [
            'config:cache' => [

            ],
        ],

        'Migrate' => [
            'migrate' => [
                '--force' => true
            ]
        ],

        'Api Doc' => [
            'apidoc:generate' => [

            ],
        ],*/

    ],

    'custom_command_shell' => [

        /*'Composer' => 'export COMPOSER_HOME=$HOME/.composer; cd .. && composer update 2>&1'*/

    ],

    'mail' => [

        'deployMailEnabled' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_ENABLED'),
        'deployMailMailer' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_MAILER'),
        'deployMailHost' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_HOST'),
        'deployMailPort' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_PORT'),
        'deployMailUsername' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_USERNAME'),
        'deployMailPassword' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_PASSWORD'),
        'deployMailFrom' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_FROM'),
        'deployMailTo' => env('LARAVEL_SIMPLE_DEPLOYER__MAIL_TO'),

    ],

];

