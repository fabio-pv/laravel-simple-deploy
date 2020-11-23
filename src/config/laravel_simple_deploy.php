<?php

return [

    'secret' => env('LARAVEL_SIMPLE_DEPLOYER__SECRET'),

    'enabled' => env('LARAVEL_SIMPLE_DEPLOYER__ENABLED', true),

    'branch' => env('LARAVEL_SIMPLE_DEPLOYER__BRANCH', 'master'),

    'git_update' => env('LARAVEL_SIMPLE_DEPLOYER__GIT_UPDATE', false),
    'artisan_migrate' => env('LARAVEL_SIMPLE_DEPLOYER__ARTISAN_MIGRATE', false),
    'artisan_config_cache' => env('LARAVEL_SIMPLE_DEPLOYER__ARTISAN_CONFIG_CACHE', false)

];
