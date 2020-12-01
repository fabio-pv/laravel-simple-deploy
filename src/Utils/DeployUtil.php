<?php


namespace LaravelSimpleDeploy\Utils;




use LaravelSimpleDeploy\Models\Deploy;
use LaravelSimpleDeploy\Models\Mail;

class DeployUtil
{
    static function getConfig()
    {

        $config = config('laravel_simple_deploy');
        
        $mail = new Mail(
            $config['mail']['deployMailEnabled'],
            $config['mail']['deployMailMailer'],
            $config['mail']['deployMailHost'],
            $config['mail']['deployMailPort'],
            $config['mail']['deployMailUsername'],
            $config['mail']['deployMailPassword'],
            $config['mail']['deployMailFrom'],
            $config['mail']['deployMailTo']
        );

        return new Deploy(
            $config['secret'],
            $config['enabled'],
            $config['branch'],
            $config['git_update'],
            $config['custom_artisan_command'],
            $config['custom_command_shell'],
            $mail
        );
    }
}
