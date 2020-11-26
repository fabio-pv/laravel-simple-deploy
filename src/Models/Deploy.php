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
 * @property array $customCommandArtisan
 * @property array $customCommandShell
 */
class Deploy
{

    public $secret;
    public $enabled;
    public $branch;
    public $gitUpdate;
    public $customCommandArtisan;
    public $customCommandShell;

    public function __construct(
        string $secret,
        string $enabled,
        string $branch,
        string $gitUpdate,
        array $customCommandArtisan,
        array $customCommandShell
    )
    {
        $this->secret = $secret;
        $this->enabled = $enabled;
        $this->branch = $branch;
        $this->gitUpdate = (bool)$gitUpdate;
        $this->customCommandArtisan = $customCommandArtisan;
        $this->customCommandShell = $customCommandShell;
    }
}
