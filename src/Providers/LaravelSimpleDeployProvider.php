<?php


namespace LaravelSimpleDeploy\Providers;


use Illuminate\Support\ServiceProvider;
use LaravelSimpleDeploy\Commands\LaravelSimpleDeployConfig;

class LaravelSimpleDeployProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(
            __DIR__ . '/../views',
            'laravel-simple-deploy'
        );
    }

    public function register()
    {
        $this->commands([
            LaravelSimpleDeployConfig::class,
        ]);
    }

}
