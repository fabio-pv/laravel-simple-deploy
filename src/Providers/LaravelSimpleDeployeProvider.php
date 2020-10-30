<?php


namespace LaravelSimpleDeploye\Providers;


use Illuminate\Support\ServiceProvider;

class LaravelSimpleDeployeProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        $this->commands([
        ]);
    }

}
