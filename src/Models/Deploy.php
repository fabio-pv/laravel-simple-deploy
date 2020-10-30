<?php


namespace LaravelSimpleDeploy\Models;

/**
 * Class Deployer
 * @package LaravelSimpleDeploy\Models
 *
 * @property string $secret
 * @property bool $enabled
 * @property string $branch
 * @property bool $gitPull
 * @property string $gitTypeAuth
 * @property string $gitTypeHttpUserName
 * @property string $gitTypeHttpPassword
 * @property string $gitTypeHttpRepo
 * @property bool $composerInstall
 * @property bool $composerUpdate
 * @property bool $artisanMigrate
 */
class Deploy
{

    public $secret;
    public $enabled;
    public $branch;
    public $gitPull;
    public $gitTypeAuth;
    public $gitTypeHttpUserName;
    public $gitTypeHttpPassword;
    public $gitTypeHttpRepo;
    public $composerInstall;
    public $composerUpdate;
    public $artisanMigrate;

    public function __construct(
        string $secret,
        string $enabled,
        string $branch,
        string $gitPull,
        string $gitTypeAuth,
        string $gitTypeHttpUserName,
        string $gitTypeHttpPassword,
        string $gitTypeHttpRepo,
        string $composerInstall,
        string $composerUpdate,
        string $artisanMigrate
    )
    {
        $this->secret = $secret;
        $this->enabled = $enabled;
        $this->branch = $branch;
        $this->gitPull = (bool)$gitPull;
        $this->gitTypeAuth = $gitTypeAuth;
        $this->gitTypeHttpUserName = $gitTypeHttpUserName;
        $this->gitTypeHttpPassword = $gitTypeHttpPassword;
        $this->gitTypeHttpRepo = $gitTypeHttpRepo;
        $this->composerInstall = (bool)$composerInstall;
        $this->composerUpdate = (bool)$composerUpdate;
        $this->artisanMigrate = $artisanMigrate;
    }

    public function getRepoWithoutHttp()
    {
        return str_replace('https://', '', $this->gitTypeHttpRepo);
    }

}
