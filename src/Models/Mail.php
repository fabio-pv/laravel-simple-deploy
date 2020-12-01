<?php

namespace LaravelSimpleDeploy\Models;

use phpDocumentor\Reflection\Types\Integer;

/**
 * Class Mail
 * @package LaravelSimpleDeploy\Models
 * @property bool $mailEnabled
 * @property string $mailMailer
 * @property string $mailHost
 * @property integer $mailPort
 * @property string $mailUsername
 * @property string $mailPassword
 * @property string $mailFrom
 * @property array $mailTo
 */
class Mail
{

    public $mailEnabled;
    public $mailMailer;
    public $mailHost;
    public $mailPort;
    public $mailUsername;
    public $mailPassword;
    public $mailFrom;
    public $mailTo;

    public function __construct(
        $mailEnabled = false,
        string $mailMailer = null,
        string $mailHost = null,
        int $mailPort = null,
        string $mailUsername = null,
        string $mailPassword = null,
        string $mailFrom = null,
        string $mailTo = null
    )
    {
        $this->mailEnabled = $mailEnabled;
        $this->mailMailer = $mailMailer;
        $this->mailHost = $mailHost;
        $this->mailPort = $mailPort;
        $this->mailUsername = $mailUsername;
        $this->mailPassword = $mailPassword;
        $this->mailFrom = $mailFrom;
        $this->mailTo = $this->setTo($mailTo);
    }

    private function setTo(string $mailtTo = null)
    {
        return explode(',', $mailtTo);
    }
}
