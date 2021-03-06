<?php

namespace SugaredRim\PhpCsFixer\Console;

use Symfony\Component\Console\Application as BaseApplication;
use PhpCsFixer\Console\Command\ReadmeCommand;
use SugaredRim\PhpCsFixer\Console\Command\FixCommand;

class Application extends BaseApplication
{
    public function __construct()
    {
        error_reporting(-1);

        parent::__construct('Sugared PHP CS Fixer');

        $this->add(new FixCommand());
        $this->add(new ReadmeCommand());

        $this->setDefaultCommand(FixCommand::COMMAND_NAME);
    }
}
