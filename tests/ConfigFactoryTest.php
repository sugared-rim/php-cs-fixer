<?php

namespace SugaredRim\PhpCsFixer;

use PhpCsFixer\Config;
use Symfony\Component\Finder\Finder;

class ConfigFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testInvokeShouldReturnConfigInstance()
    {
        $factory = new ConfigFactory();
        $sut = $factory('sugared-rim/php-cs-fixer no-presets');
        $this->assertInstanceOf(Config::class, $sut);
        $this->assertInstanceOf(Finder::class, $sut->getFinder());
    }
}
