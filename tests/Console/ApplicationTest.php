<?php

namespace Schnittstabil\Sugared\PhpCsFixer\Console;

use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Tester\ApplicationTester;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Filesystem\Filesystem;
use Schnittstabil\Sugared\PhpCsFixer\Console\Command\FixCommand;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $filesystem = new Filesystem();
        $filesystem->remove('.php_cs.cache');
    }

    public function testRunShouldUpdateByDefault()
    {
        $command = null;
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener('console.command', function (ConsoleCommandEvent $event) use (&$command) {
            $command = $event->getCommand();
            $event->disableCommand();
        });

        $application = new Application();
        $application->setDispatcher($dispatcher);
        $application->setAutoExit(false);
        $application->setCatchExceptions(false);

        $tester = new ApplicationTester($application);
        $tester->run([], ['decorated' => false]);

        $this->assertInstanceOf(FixCommand::class, $command);
    }
}
