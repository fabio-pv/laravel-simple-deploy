<?php

namespace LaravelSimpleDeploy\Commands;

use Illuminate\Console\Command;

class LaravelSimpleDeployConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabio-pv:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the file to config';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $source = getcwd() . '/vendor/fabio/laravel-simple-deploy/src/config/laravel_simple_deploy.php';
        $dest = getcwd() . '/config/laravel_simple_deploy.php';
        $result = copy($source, $dest);

        if ($result === true) {
            echo 'Generate file in ' . $dest;
            echo PHP_EOL;
        }

        return 0;
    }
}
