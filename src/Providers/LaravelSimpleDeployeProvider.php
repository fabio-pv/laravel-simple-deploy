<?php


namespace LaravelSimpleDeploye\Providers;


use Illuminate\Support\ServiceProvider;
use LaravelSimpleDeploye\Commands\LaravelSimpleDeployConfig;

class LaravelSimpleDeployeProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        $this->commands([
            LaravelSimpleDeployConfig::class
        ]);
    }

}
