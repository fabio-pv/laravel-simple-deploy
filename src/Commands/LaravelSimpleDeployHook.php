<?php

namespace LaravelSimpleDeploy\Commands;

use Illuminate\Console\Command;

class LaravelSimpleDeployHook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fabio-pv:deploy-hook';

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
        $source = getcwd() . '/vendor/fabio/laravel-simple-deploy/src/hooks/post-merge';
        $dest = getcwd() . '/.git/hooks/post-merge';
        $result = copy($source, $dest);
        chmod($dest, 0755);

        if ($result === true) {
            echo 'Generate file in ' . $dest;
            echo PHP_EOL;
        }

        return 0;
    }
}
