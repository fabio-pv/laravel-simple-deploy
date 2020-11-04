<?php


namespace LaravelSimpleDeploy\Providers;


use Illuminate\Support\ServiceProvider;
use LaravelSimpleDeploy\Commands\LaravelSimpleDeployConfig;
use LaravelSimpleDeploy\Commands\LaravelSimpleDeployHook;

class LaravelSimpleDeployProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        $this->commands([
            LaravelSimpleDeployConfig::class,
            LaravelSimpleDeployHook::class,
        ]);
    }

}
