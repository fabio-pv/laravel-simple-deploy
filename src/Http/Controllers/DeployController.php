<?php


namespace LaravelSimpleDeploy\Http\Controllers;


use Illuminate\Support\Facades\Artisan;
use LaravelSimpleDeploy\Utils\DeployUtil;

class DeployController
{

    private $config;

    public function __construct()
    {
        $this->config = DeployUtil::getConfig();
    }

    public function start()
    {
        try {

            /*$this->verifySecret();*/

            if ($this->config->enabled === false) {
                throw new \Exception('Deployer not enabled');
            }

            $response = $this->shouldDoDeployer();
            if ($response === false) {
                return response()->json(
                    ['message' => 'Branch *** was not chosen for automatic deployment'],
                    200
                );
            }

            $this->updateGit();
            $this->startMigrate();

            return response()->json(
                'Finalizado',
                200
            );

        } catch (\Exception $e) {
            throw $e;
        }

    }

    private function verifySecret()
    {

        $rawPost = file_get_contents('php://input');
        $payloadHash = 'sha256=' . hash_hmac('sha256', $rawPost, $this->config->secret, false);
        $hash = \request()->header('X-Hub-Signature-256');

        $result = hash_equals(
            $payloadHash,
            $hash
        );

        if ($result !== true) {
            throw new \Exception('Secret not corrent');
        }

    }

    private function shouldDoDeployer()
    {
        try {

            $ref = \request()->all()['ref'];

            if (str_contains($ref, $this->config->branch)) {
                return true;
            }

            return false;


        } catch (\Exception $e) {
            throw $e;
        }

    }

    private function updateGit()
    {
        try{

            $command = 'git fetch';
            exec($command, $result);
            $this->startMessageProcess('GIT', $result);

            $command = 'git fetch origin ' . $this->config->branch;
            exec($command, $result);
            $this->startMessageProcess('GIT', $result);

            $command = 'git reset --hard FETCH_HEAD';
            exec($command, $result);
            $this->startMessageProcess('GIT', $result);

            $command = 'git clean -df';
            exec($command, $result);
            $this->startMessageProcess('GIT', $result);

        }catch (\Exception $e){
            throw $e;
        }
    }

    private function startMessageProcess($process, $output = [])
    {
        echo '*** ' . $process . ' ***' . PHP_EOL;
        echo PHP_EOL;

        foreach ($output as $item) {
            echo '* ' . $item . PHP_EOL;
        }

        echo PHP_EOL;
    }

    private function startMigrate()
    {

        if ($this->config->artisanMigrate !== true) {
            return;
        }

        sleep(30);

        Artisan::call('migrate', [
            '--force' => true,
        ]);
        $this->startMessageProcess('Migrate');
    }
}
