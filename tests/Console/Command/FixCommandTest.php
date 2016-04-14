<?php

namespace Schnittstabil\Sugared\PhpCsFixer\Console\Command;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Filesystem\Filesystem;

class FixCommandTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $filesystem = new Filesystem();
        $filesystem->remove('.php_cs.cache');
    }

    protected function runFixCommand(array $argv)
    {
        array_unshift($argv, 'fix');
        array_unshift($argv, '-');
        $input = new ArgvInput($argv);
        $output = new BufferedOutput();

        $command = $this->getMockBuilder(FixCommand::class)
                     ->setMethods(['execute'])
                     ->getMock();
        $command->method('execute')->willReturn(0);

        $command->run($input, $output);

        return [
            'command' => $command,
            'input' => $input,
            'output' => $output->fetch(),
        ];
    }

    public function testExecuteShouldAllowDiffOption()
    {
        $input = $this->runFixCommand(['--diff=true'])['input'];

        $this->assertEquals(true, $input->getOption('diff'));
    }

    public function testExecuteShouldAllowDiffOptionWithoutValue()
    {
        $input = $this->runFixCommand(['--diff'])['input'];

        $this->assertEquals(true, $input->getOption('diff'));
    }

    public function testExecuteShouldAllowMultipleDiffOptions()
    {
        $input = $this->runFixCommand(['--diff=true', '--diff=false'])['input'];

        $this->assertEquals(false, $input->getOption('diff'));
    }

    public function testExecuteShouldAllowDryRunOption()
    {
        $input = $this->runFixCommand(['--dry-run=true'])['input'];

        $this->assertEquals(true, $input->getOption('dry-run'));
    }

    public function testExecuteShouldAllowDryRunOptionWithoutValue()
    {
        $input = $this->runFixCommand(['--dry-run'])['input'];

        $this->assertEquals(true, $input->getOption('dry-run'));
    }

    public function testExecuteShouldAllowMultipleDryRunOptions()
    {
        $input = $this->runFixCommand(['--dry-run=true', '--dry-run=false'])['input'];

        $this->assertEquals(false, $input->getOption('dry-run'));
    }
}
