<?php


namespace LaravelSimpleDeploy\Models;

/**
 * Class Deployer
 * @package LaravelSimpleDeploy\Models
 *
 * @property string $secret
 * @property bool $enabled
 * @property string $branch
 * @property bool $gitUpdate
 * @property bool $artisanMigrate
 * @property bool $artisanConfigCache
 */
class Deploy
{

    public $secret;
    public $enabled;
    public $branch;
    public $gitUpdate;
    public $artisanMigrate;
    public $artisanConfigCache;

    public function __construct(
        string $secret,
        string $enabled,
        string $branch,
        string $gitUpdate,
        string $artisanMigrate,
        string $artisanConfigCache
    )
    {
        $this->secret = $secret;
        $this->enabled = $enabled;
        $this->branch = $branch;
        $this->gitUpdate = (bool)$gitUpdate;
        $this->artisanMigrate = (bool)$artisanMigrate;
        $this->artisanConfigCache = (bool)$artisanConfigCache;
    }

    public function getRepoWithoutHttp()
    {
        return str_replace('https://', '', $this->gitTypeHttpRepo);
    }

}
