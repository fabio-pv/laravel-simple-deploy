<?php


namespace LaravelSimpleDeploy\Http\Controllers;


use Illuminate\Support\Facades\Artisan;
use LaravelSimpleDeploy\Utils\DeployUtil;

class DeployController
{

    private $config;
    private $posts = [];

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

            $this->updateGit();
            $this->customShellCommand();
            $this->customArtisanCommand();
            $this->sendMail();

            return response()->json(
                'End',
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
        try {

            if ($this->config->gitUpdate !== true) {
                return;
            }

            $this->startMessageProcess('GIT');

            $command = 'git fetch';
            exec($command, $result);
            $this->startMessageProcess(null, $result);

            $command = 'git fetch origin ' . $this->config->branch;
            exec($command, $result);
            $this->startMessageProcess(null, $result);

            $command = 'git reset --hard FETCH_HEAD';
            exec($command, $result);
            $this->startMessageProcess(null, $result);

            $command = 'git clean -df';
            exec($command, $result);
            $this->startMessageProcess(null, $result);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function customArtisanCommand()
    {
        foreach ($this->config->customCommandArtisan as $index => $command) {
            $this->runCustomArtisanCommand(
                $index,
                array_keys($command)[0],
                array_values($command)[0]
            );
        }
    }

    private function runCustomArtisanCommand($name, $command, $options = [])
    {
        try {

            Artisan::call($command, $options);
            $this->startMessageProcess($name, [Artisan::output()]);

        } catch (\Exception $e) {
            $this->startMessageProcess($name, [$e->getMessage()]);
        }
    }

    private function customShellCommand()
    {
        foreach ($this->config->customCommandShell as $index => $command) {
            $this->runCustomShellCommand($index, $command);;
        }
    }

    private function runCustomShellCommand($title, $command)
    {
        exec($command, $result);
        $this->startMessageProcess($title, $result);
    }

    private function startMessageProcess($process = null, $output = [])
    {
        if (!empty($process)) {
            $title = '*** ' . $process . ' ***' . PHP_EOL;
            echo $title;
            $this->posts[] = $title;

        }

        foreach ($output as $item) {
            $post = $item . PHP_EOL;
            echo $post;
            $this->posts[] = $post;
        }
    }

    private function sendMail()
    {
        if ($this->config->mail->mailEnabled !== true) {
            return;
        }

        $body = implode(PHP_EOL, $this->posts);

        $transport = (new \Swift_SmtpTransport(
            $this->config->mail->mailHost,
            $this->config->mail->mailPort
        ))
            ->setUsername($this->config->mail->mailUsername)
            ->setPassword($this->config->mail->mailPassword);

        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message('Deploy'))
            ->setFrom([
                $this->config->mail->mailFrom => 'Deploy'
            ])
            ->setTo(
                $this->config->mail->mailTo
            )
            ->setBody($body);

        $result = $mailer->send($message);
    }
}
