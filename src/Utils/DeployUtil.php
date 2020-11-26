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
            $config['git_update'],
            $config['custom_artisan_command'],
            $config['custom_command_shell']
        );
    }
}
