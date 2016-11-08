<?php

namespace SugaredRim\PhpCsFixer;

use Symfony\CS\Config\Config;
use Symfony\Component\Finder\Finder;

class ConfigFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testInvokeShouldReturnConfigInstance()
    {
        $factory = new ConfigFactory();
        $sut = $factory('sugared-rim/php-cs-fixer no-presets');
        $this->assertInstanceOf(Config::class, $sut);
        $this->assertInstanceOf(Finder::class, $sut->getFinder());
    }
}
