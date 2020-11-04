<?php


namespace LaravelSimpleDeploy\Utils;




use LaravelSimpleDeploy\Models\Deploy;

class DeployUtil
{
    static function getConfig()
    {

        $config = config('laravel_simple_deploy');

        return new Deploy(
            $config['secret'],
            $config['enabled'],
            $config['branch'],
            $config['git_pull'],
            $config['git_type_auth'],
            $config['git_type_http_username'],
            $config['git_type_http_password'],
            $config['git_type_http_repo'],
            $config['artisan_migrate']
        );
    }
}