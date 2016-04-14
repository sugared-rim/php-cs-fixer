<?php

namespace Schnittstabil\Sugared\PhpCsFixer;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testGetShouldReturnNullOnUnknown()
    {
        $sut = new Config();
        $this->assertSame(null, $sut->{uniqid()});
    }

    public function testSetUnset()
    {
        $sut = new Config();
        $key = uniqid();
        $this->assertFalse(isset($sut->$key));
        $sut->$key = true;
        $this->assertTrue(isset($sut->$key));
        unset($sut->$key);
        $this->assertFalse(isset($sut->$key));
    }
}
