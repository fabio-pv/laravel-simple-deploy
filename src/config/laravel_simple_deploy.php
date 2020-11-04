<?php

return [

    'secret' => env('LARAVEL_SIMPLE_DEPLOYER__SECRET'),

    'enabled' => env('LARAVEL_SIMPLE_DEPLOYER__ENABLED', true),

    'branch' => env('LARAVEL_SIMPLE_DEPLOYER__BRANCH', 'master'),

    'git_pull' => env('LARAVEL_SIMPLE_DEPLOYER__GIT_PULL', false),
    'git_type_auth' => env('LARAVEL_SIMPLE_DEPLOYER__GIT_AUTH', 'http'),
    'git_type_http_username' => env('LARAVEL_SIMPLE_DEPLOYER__GIT_TYPE_HTTP_USERNAME'),
    'git_type_http_password' => env('LARAVEL_SIMPLE_DEPLOYER__GIT_TYPE_HTTP_PASSWORD'),
    'git_type_http_repo' => env('LARAVEL_SIMPLE_DEPLOYER__GIT_TYPE_HTTP_REPO'),
    
    'artisan_migrate' => env('LARAVEL_SIMPLE_DEPLOYER_ARTISAN_MIGRATE', false),

];
