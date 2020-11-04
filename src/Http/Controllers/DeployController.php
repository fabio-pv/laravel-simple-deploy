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

            $this->startGitPull();
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

    private function startGitPull()
    {
        try {

            if ($this->config->gitPull !== true) {
                return;
            }

            $command =
                'git pull https://'
                . $this->config->gitTypeHttpUserName
                . ':'
                . $this->config->gitTypeHttpPassword
                . '@'
                . $this->config->getRepoWithoutHttp()
                . ' '
                . $this->config->branch
                . ' > /dev/null 2>&1 &';

            exec($command, $result);
            $this->startMessageProcess('GIT', $result);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function startMessageProcess($process, $output = [])
    {
        echo '*** ' . $process . ' ***' . PHP_EOL;
        echo PHP_EOL;

        foreach ($output as $item) {
            echo $item . PHP_EOL;
        }

        echo PHP_EOL;
    }

    private function startMigrate()
    {

        if ($this->config->artisanMigrate !== true) {
            return;
        }

        $exitCode = Artisan::call('migrate', [
            '--force' => true,
        ]);
        $this->startMessageProcess('Migrate');
    }
}
