<?php

namespace Schnittstabil\Sugared\PhpCsFixer\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\CS\Console\Command\ReadmeCommand;
use Schnittstabil\Sugared\PhpCsFixer\Console\Command\FixCommand;

class Application extends BaseApplication
{
    public function __construct()
    {
        error_reporting(-1);

        parent::__construct('Sugared PHP CS Fixer');

        $this->add(new FixCommand());
        $this->add(new ReadmeCommand());

        $this->setDefaultCommand('fix');
    }
}
