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

];

