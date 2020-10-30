<?php


namespace LaravelSimpleDeploy\Http\Controllers;


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

            $this->verifySecret();

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
            $this->startComposerInstall();
            $this->startComposerUpdate();

            return response()->json(
                'start',
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
                . $this->config->branch;

            exec($command, $result);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function startComposerInstall()
    {
        try {

            if ($this->config->composerInstall !== true) {
                return;
            }

            putenv("HOME=" . getcwd());
            exec('cd .. && /usr/local/bin/composer install > /dev/null 2>&1 &');

        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function startComposerUpdate()
    {
        try {
            if ($this->config->composerUpdate !== true) {
                return;
            }

            putenv("HOME=" . getcwd());
            exec('cd .. && /usr/local/bin/composer update > /dev/null 2>&1 &');

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
